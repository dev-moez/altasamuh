<div>
    <div class="flex flex-col w-full p-4 bg-white rounded-xl md:p-5 ">
        <div class="">
            <h1 class="mb-6 text-lg font-bold">
                ملخص
            </h1>
        </div>
        <div class="flex items-center justify-between px-3 py-4 bg-gray-200 rounded-lg">
            <div>
                عدد المشاريع: {{ $donationsCount }}
            </div>
            <div>
                إجمالي التبرعات: {{ $donationsSum }} د.ك
            </div>
        </div>
        <div>
            <div class="flex flex-col mt-5">
                <div class="-m-1.5 overflow-x-auto">
                    <div class="p-1.5 min-w-full inline-block align-middle">
                        <div class="overflow-hidden">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead>
                                    <tr class="bg-gray-100 rounded-md">
                                        <th scope="col" class="px-6 py-2 font-medium text-gray-500 uppercase text-md text-start"></th>
                                        <th scope="col" class="px-6 py-2 font-medium text-center text-gray-500 uppercase text-md">المشاريع</th>
                                        <th scope="col" class="px-6 py-2 font-medium text-center text-gray-500 uppercase text-md">مبلغ التبرع</th>
                                        <th scope="col" class="px-6 py-2 font-medium text-center text-gray-500 uppercase text-md">التاريخ</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-gray-200">
                                    @forelse ($donations as $donation)
                                        <tr class="">
                                            <td class="px-6 py-4 font-medium text-center text-gray-800 text-md whitespace-nowrap">{{ $loop->iteration }}</td>
                                            <td class="px-6 py-4 text-gray-800 text-md whitespace-nowrap">{{ $donation->donationable->title }}</td>
                                            <td class="px-6 py-4 text-center text-gray-800 text-md whitespace-nowrap">{{ $donation->amount }} د.ك</td>
                                            <td class="px-6 py-4 text-center text-gray-800 text-md whitespace-nowrap">{{ $donation->created_at }}</td>
                                        </tr>
                                    @empty
                                    @endforelse
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
