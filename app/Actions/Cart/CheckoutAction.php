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
    public function __construct(?string $phone_number = null)
    {
        $this->phone_number = $phone_number;
        $this->cart = Cart::where(function ($query) {
            $query->where('user_id', auth()->id())->orWhere('session_id', session()->get('session_id'));
        })->where('checked_out', false)->with('items')->first();
    }

    public function execute()
    {
        $postFields = [
            'NotificationOption' => 'Lnk',
            'InvoiceValue' => $this->cart->amount,
            'CustomerName' => auth()->user()->name ?? 'فاعل خير',
            'CustomerMobile' => auth()->user()->phone_number ?? $this->phone_number ?? null,
        ];

        $orderId = uniqid();
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
                'affiliate_id' => Session::get('affiliate_id') ?? null
            ]);

            $this->cart->update(['checked_out' => true]);
        });
        // foreach ($this->cart->items as $cartItem) {
        //     Donation::create([
        //         'donationable_type' => $cartItem->cartable_type,
        //         'donationable_id' => $cartItem->cartable_id,
        //         'user_id' => auth()->id(),
        //         'amount' => $cartItem->amount,
        //     ])->transaction()->create([
        //         'user_id' => auth()->id(),
        //         'amount' => $cartItem->amount,
        //         'invoice_id' => $paymentData['invoiceId'],
        //         'invoice_url' => $paymentData['invoiceURL'],
        //         'order_id' => $orderId
        //     ]);
        // }
        // $this->cart->update(['checked_out' => true]);
        return redirect()->away($paymentData['invoiceURL']);
        // if ($paymentData['invoiceURL']) {
        //     return $paymentData['invoiceURL'];
        // }
    }
}
