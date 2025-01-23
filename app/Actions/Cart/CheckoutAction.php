<?php

namespace App\Actions\Cart;

use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
use App\Models\Donation;
use MyFatoorah\Library\API\Payment\MyFatoorahPayment;
use Illuminate\Support\Facades\DB;
use App\Models\Transaction;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cookie;

class CheckoutAction
{
    public $cart;
    public ?string $phone_number;

    public function __construct(public readonly ?int $paymentMethodId = 2) {}

    public function execute()
    {
        $userId = auth()->check() ? auth()->user()->id : null;
        if (is_null($userId)) {
            $this->cart = Cart::where(function ($query) use ($userId) {
                $query->where('session_id', Cookie::get('altasamuh_cart_cookie'));
            })->notCheckedout()->with('items')->firstOrFail();
        } else {
            $this->cart = Cart::firstOrCreate(['user_id' => Auth::id(), 'checked_out' => false]);
        }

        $orderId = uniqid();
        $postFields = [
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $this->cart->load('items')->amount,
            'CustomerName' => auth()->user()->name ?? 'فاعل خير',
            'CustomerMobile' => auth()->check() ? auth()->user()->phone_number : $this->cart->phone_number,
            'MobileCountryCode' => auth()->check() ? auth()->user()->country_code :  $this->cart->country_code,
            'CallBackUrl' => route('payment.success'),
            'ErrorUrl' => route('payment.failed'),
        ];

        $mfPayment = new MyFatoorahPayment([
            'apiKey' => config('myfatoorah.api_key'),
            'countryCode' => config('myfatoorah.country_iso'),
            'isTest' => config('myfatoorah.test_mode'),
        ]);
        $paymentData = $mfPayment->getInvoiceURL($postFields, $this->paymentMethodId, $orderId);
        DB::transaction(function () use ($paymentData, $orderId) {
            $transaction = Transaction::create([
                'user_id' => auth()->user()?->id,
                'amount' => $this->cart->amount,
                'invoice_id' => $paymentData['invoiceId'],
                'invoice_url' => $paymentData['invoiceURL'],
                'order_id' => $orderId,
                'cart_id' => $this->cart->id,
                'phone_number' => $this->cart->phone_number,
                'country_code' => $this->cart->country_code,
                'affiliate_id' => Session::get('affiliate_id') ?? null
            ]);

            $this->cart->update(['checked_out' => true]);
        });

        return redirect()->away($paymentData['invoiceURL']);
    }
}
