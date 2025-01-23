<?php

namespace App\Livewire\Payment;

use Livewire\Component;
use App\Models\Transaction;
use MyFatoorah\Library\API\Payment\MyFatoorahPaymentStatus;
use Illuminate\Http\Request;

class Failed extends Component
{
    public function mount(Request $request)
    {
        $mfPayment = new MyFatoorahPaymentStatus([
            'apiKey' => config('myfatoorah.api_key'),
            'countryCode' => config('myfatoorah.country_iso'),
            'isTest' => config('myfatoorah.test_mode'),
        ]);
        $paymentId = $request->get('paymentId');
        $paymentData = $mfPayment->getPaymentStatus(keyId: $paymentId, KeyType: 'PaymentId');
        Transaction::where('invoice_id', $paymentData->InvoiceId)
            ->update([
                'redirect_response' => json_encode($paymentData)
            ]);
    }
    public function render()
    {
        return view('livewire.payment.failed');
    }
}
