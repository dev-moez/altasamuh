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

class CheckoutAction
{
    public $cart;
    public ?string $phone_number;
    public function __construct()
    {
        $this->cart = Cart::where(function ($query) {
            $query->where('user_id', auth()->id())
                ->orWhere('session_id', session()->get('altasamuh_cart_session_id'));
        })->where('checked_out', false)->with('items')->firstOrFail();
    }

    public function execute()
    {
        $orderId = uniqid();
        $postFields = [
            'NotificationOption' => 'LNK',
            'InvoiceValue' => $this->cart->load('items')->amount,
            'CustomerName' => auth()->user()->name ?? 'فاعل خير',
            'CustomerMobile' => auth()->check() ? auth()->user()->phone_number : $this->cart->phone_number,
            'MobileCountryCode' => auth()->check() ? auth()->user()->country_code :  $this->cart->country_code,
            'CallBackUrl' => route('payment.success'),
            'ErrorUrl' => route('payment.failed'),
            'PaymentMethodId' => 2
        ];

        $mfPayment = new MyFatoorahPayment([
            'apiKey' => config('myfatoorah.api_key'),
            'countryCode' => config('myfatoorah.country_iso'),
            'isTest' => config('myfatoorah.test_mode'),
        ]);
        $paymentData = $mfPayment->getInvoiceURL(curlData: $postFields, orderId: $orderId);
        DB::transaction(function () use ($paymentData, $orderId) {
            Transaction::create([
                'user_id' => auth()->id(),
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
        // Session::forget('altasamuh_cart_session_id');
        return redirect()->away($paymentData['invoiceURL']);
    }
}
