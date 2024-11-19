<div>
    <div class="container">
        <div class="max-w-xl p-4 mx-auto my-12 bg-white shadow sm:p-8 sm:rounded-lg">
            <div class="mb-5">
                <h1 class="text-2xl font-bold text-center text-green-500">تفاصيل التبرع</h1>
                <p class="p-4 mt-4 text-center text-[#07A54F] bg-green-100 rounded-lg">
                    تمت عملية التبرع بنجاح
                </p>
            </div>
            <div class="p-4">
                <div class="flex flex-col">
                    <div class="-m-1.5 overflow-x-auto">
                        <div class="p-1.5 min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-gray-200">
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-bold text-gray-800 whitespace-nowrap">نتيجة العملية</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">عملية الدفع مقبولة</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-bold text-gray-800 whitespace-nowrap">المبلغ</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ $paymentData->InvoiceValue }} د.ك</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-bold text-gray-800 whitespace-nowrap">الرقم المرجعي</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ $paymentData->CustomerReference }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-bold text-gray-800 whitespace-nowrap">رقم الفاتورة</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ $paymentData->InvoiceId }}</td>
                                        </tr>
                                        <tr>
                                            <td class="px-6 py-4 text-sm font-bold text-gray-800 whitespace-nowrap">التاريخ</td>
                                            <td class="px-6 py-4 text-sm text-gray-800 whitespace-nowrap">{{ $paymentData->InvoiceTransactions[0]->TransactionDate }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
