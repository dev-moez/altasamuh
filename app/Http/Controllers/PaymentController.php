<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        if ($request->Event == 'TransactionsStatusChanged') {
            $data = $request->Data;
            $invoiceId = $data['InvoiceId'];
            $status = $data['TransactionStatus'];
            $paidAt = $status == 'SUCCESS' ? now() : null;
            Transaction::where('invoice_id', $invoiceId)
                ->update([
                    'status' => $status,
                    'paid_at' => $paidAt,
                    'callback_response' => json_encode($request->all()),
                ]);
        }
    }
}
