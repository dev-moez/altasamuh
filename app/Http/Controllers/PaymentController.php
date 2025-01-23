<?php

namespace App\Http\Controllers;

use App\Actions\WhatsApp\SendPaymentConfirmationAction;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Donation;
use Illuminate\Support\Facades\DB;
use MyFatoorah\Library\API\Payment\MyFatoorahPayment;
use MyFatoorah\Library\API\Payment\MyFatoorahPaymentStatus;
use App\Actions\WhatsApp\SendPaymentFailedAction;

class PaymentController extends Controller
{

    public function callback(Request $request)
    {
        if ($request->Event == 'TransactionsStatusChanged') {
            $data = $request->Data;
            $invoiceId = $data['InvoiceId'];
            $status = $data['TransactionStatus'];
            $paidAt = $status == 'SUCCESS' ? now() : null;
            $transaction = Transaction::where('invoice_id', $invoiceId)->first();
            DB::transaction(function () use (&$transaction, &$status, &$paidAt, &$request) {
                $transaction
                    ->update([
                        'status' => $status,
                        'paid_at' => $paidAt,
                        'callback_response' => json_encode($request->all()),
                    ]);

                if ($status == 'SUCCESS') {
                    foreach ($transaction->cart->items as $cartItem) {
                        Donation::create([
                            'transaction_id' => $transaction->id,
                            'donationable_type' => $cartItem->cartable_type,
                            'donationable_id' => $cartItem->cartable_id,
                            'amount' => $cartItem->amount,
                            'user_id' => $transaction->user_id,
                            'phone_number' => $transaction->phone_number,
                            'name' => 'فاعل خير',
                            'affiliate_id' => $transaction->affiliate_id,
                        ]);

                        $phoneNumber = $transaction->fullPhoneNumber();

                        (new SendPaymentConfirmationAction($phoneNumber))->execute($cartItem->amount, $cartItem->cartable->title, $transaction->created_at);
                    }
                } else {
                    foreach ($transaction->cart->items as $cartItem) {
                        $phoneNumber = $transaction->user ? $transaction->user->fullPhoneNumber() : $transaction->fullPhoneNumber();
                        if (!is_null($phoneNumber)) {
                            (new SendPaymentFailedAction($phoneNumber))->execute($cartItem->amount, $cartItem->cartable->title, $transaction->created_at);
                        }
                    }
                }
            });
        }
    }
}
