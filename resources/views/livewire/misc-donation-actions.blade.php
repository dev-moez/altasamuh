@use('App\Enums\PaymentMethodEnum', 'PaymentMethodEnum')
<div>
    <div class="flex flex-wrap gap-3 mt-4">
        @forelse($miscDonations as $donation)
            <button type="button" wire:click.prevent="$set('misc_donation_id', {{ $donation->id }} )" class="px-3 py-2 lg:text-lg text-xs rounded-md font-bold {{ $misc_donation_id == $donation->id ? 'bg-green-500 text-white' : 'text-gray-800 bg-gray-200' }}">{{ $donation->title }}</button>
        @empty
        @endforelse
    </div>
    {{-- Make donation  --}}
    <div class="flex items-center justify-between gap-4 mt-5">
        <div class="font-bold text-nowrap">
            <span class="text-[#979797]">
                أدخل المبلغ
            </span>
        </div>
        <!-- Input Number -->
        <div class="order-1 inline-block w-full px-3 py-2 bg-white border border-gray-200 rounded-lg lg:order-2">
            <div class ="flex items-center gap-x-1.5" x-data="{ count: @entangle('amount') }">
                <button @click="count--" type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" tabindex="-1" aria-label="Decrease">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                    </svg>
                </button>
                <input type="number" @entangle('amount') x-model="count" wire:model.live="amount" min="1" class="min-w-24 w-full p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none --prevent-on-load-init" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="0">
                <button @click.prevent="count++" type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" tabindex="-1" aria-label="Increase">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                        <path d="M12 5v14"></path>
                    </svg>
                </button>
            </div>
        </div>
        <!-- End Input Number -->
    </div>
    <div class="flex items-center justify-center w-full gap-4 mt-3">
        {{-- <div class="grid w-full grid-cols-1 lg:grid-cols-2 gap-x-4 gap-y-2"> --}}
        {{-- <div class="flex flex-wrap items-center justify-center order-2 gap-3 lg:order-1"> --}}
        @forelse($quickDonations as $quickDonation)
            <button type="button" wire:click.prevent="$set('amount', {{ $quickDonation->value }})" class="inline-flex px-4 py-1 border border-gray-400 rounded-3xl {{ $amount == $quickDonation->value ? 'bg-green-500 border-green-500 text-white' : '' }}" wire:click="$set('amount', {{ $quickDonation->value }}}">{{ $quickDonation->value }}</button>
        @empty
        @endforelse
        {{-- </div> --}}
        {{-- </div> --}}
    </div>

    <div class="flex items-center justify-center w-full mx-auto mt-4 gap-x-3">
        <button wire:click.prevent="$set('paymentMethodId', {{ PaymentMethodEnum::KNET->value }})" class="flex items-center w-16 h-10 {{ $paymentMethodId == PaymentMethodEnum::KNET->value ? 'border-[3px] border-[#0072BB]' : 'border border-gray-300' }} rounded-md">
            <img src="{{ asset('images/knet.png') }}" alt="" class="block w-10 max-w-full mx-auto max-h-8">
        </button>
        <button wire:click.prevent="$set('paymentMethodId', {{ PaymentMethodEnum::VISA_MASTER_CARD->value }})" class="flex items-center w-16 h-10 {{ $paymentMethodId == PaymentMethodEnum::VISA_MASTER_CARD->value ? 'border-[3px] border-[#0072BB]' : 'border border-gray-300' }} rounded-md">
            <img src="{{ asset('images/visa-master-card.png') }}" alt="" class="block w-8 max-w-full mx-auto max-h-6">
        </button>
        <button wire:click.prevent="$set('paymentMethodId', {{ PaymentMethodEnum::APPLE_PAY->value }})" class="flex items-center w-16 h-10 {{ $paymentMethodId == PaymentMethodEnum::APPLE_PAY->value ? 'border-[3px] border-[#0072BB]' : 'border border-gray-300' }} rounded-md">
            <img src="{{ asset('images/apple-pay.png') }}" alt="" class="block w-8 max-w-full mx-auto max-h-8">
        </button>
    </div>
    {{-- Actions --}}
    <div class="flex flex-grow gap-4 my-4" wire:ignore>
        <x-primary-button wire:loading.attr="disabled" wire:click.prevent="donate" class="flex-1 w-full lg:w-auto">تبرع الان</x-primary-button>
        <x-primary-button wire:loading.attr="disabled" wire:click.prevent="addToCart" class="flex-1 w-full lg:w-auto bg-[#DCDCDC] text-[#3F3F3F] gap-x-2 hover:!bg-gray-400 hover:!text-white">
            <span class="text-[#3F3F3F]">أضف للسلة</span>
            <svg class="hidden lg:inline-block" width="20" height="18" viewBox="0 0 16 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0.699385 -0.000201416C0.422627 -0.000201416 0.199219 0.234299 0.199219 0.524799C0.199219 0.815299 0.422627 1.0498 0.699385 1.0498H2.29325L4.01216 9.5653C4.08051 9.88555 4.28058 10.1533 4.534 10.1498H12.8701C13.1335 10.1533 13.3769 9.90305 13.3769 9.6248C13.3769 9.34655 13.1335 9.0963 12.8701 9.0998H4.9408L4.72739 8.0498H13.537C13.7604 8.04805 13.9721 7.86955 14.0222 7.6403L15.1892 2.3903C15.2542 2.0858 15.0025 1.7533 14.7041 1.7498H3.46031L3.18855 0.414548C3.14187 0.181798 2.92513 -0.00195312 2.69839 -0.00195312H0.699385V-0.000201416ZM3.66871 2.7998H14.0738L13.1419 6.9998H4.51899L3.66871 2.7998ZM6.20122 10.4998C5.28591 10.4998 4.534 11.289 4.534 12.2498C4.534 13.2105 5.28591 13.9998 6.20122 13.9998C7.11652 13.9998 7.86844 13.2105 7.86844 12.2498C7.86844 11.289 7.11652 10.4998 6.20122 10.4998ZM11.2029 10.4998C10.2876 10.4998 9.53566 11.289 9.53566 12.2498C9.53566 13.2105 10.2876 13.9998 11.2029 13.9998C12.1182 13.9998 12.8701 13.2105 12.8701 12.2498C12.8701 11.289 12.1182 10.4998 11.2029 10.4998ZM6.20122 11.5498C6.57468 11.5498 6.86811 11.8578 6.86811 12.2498C6.86811 12.6418 6.57468 12.9498 6.20122 12.9498C5.82776 12.9498 5.53433 12.6418 5.53433 12.2498C5.53433 11.8578 5.82776 11.5498 6.20122 11.5498ZM11.2029 11.5498C11.5763 11.5498 11.8698 11.8578 11.8698 12.2498C11.8698 12.6418 11.5763 12.9498 11.2029 12.9498C10.8294 12.9498 10.536 12.6418 10.536 12.2498C10.536 11.8578 10.8294 11.5498 11.2029 11.5498Z" fill="#3F3F3F" />
            </svg>
        </x-primary-button>
    </div>
    <div>
        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        <x-input-error class="mt-2" :messages="$errors->get('misc_donation_id')" />
        <x-input-error :messages="$errors->get('paymentMethodId')" class="mt-2" />
    </div>
</div>
