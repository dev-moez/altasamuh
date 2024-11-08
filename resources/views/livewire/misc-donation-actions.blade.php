<div>
    <div class="flex flex-wrap gap-3 mt-4">
        @forelse($miscDonations as $donation)
            <button type="button" wire:click.prevent="$set('misc_donation_id', {{ $donation->id }} )" class="px-5 py-2 text-sm rounded-md {{ $misc_donation_id == $donation->id ? 'bg-green-500 text-white' : 'text-gray-800 bg-gray-200' }}">{{ $donation->title }}</button>
        @empty
        @endforelse
    </div>
    {{-- Make donation  --}}
    <div class="mt-5">
        <div>أدخل المبلغ بالدينار</div>
        <div class="flex items-center justify-between w-full gap-4 mt-5">
            <div class="grid w-full grid-cols-2 gap-x-4">
                <div class="flex flex-wrap items-center gap-3">
                    @forelse($quickDonations as $quickDonation)
                        <button type="button" wire:click.prevent="$set('amount', {{ $quickDonation->value }})" class="inline-flex p-2 border border-gray-400 rounded-3xl {{ $amount == $quickDonation->value ? 'bg-green-500 border-green-500 text-white' : '' }}" wire:click="$set('amount', {{ $quickDonation->value }}}">{{ $quickDonation->value }}</button>
                    @empty
                    @endforelse
                </div>

                <!-- Input Number -->
                <div class="inline-block px-3 py-2 bg-white border border-gray-200 rounded-lg w-fit align-self-end" data-hs-input-number="">
                    <div class="flex items-center gap-x-1.5 w-fit">
                        <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                            </svg>
                        </button>
                        <input wire:model.live="amount" class="min-w-24 p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="0" data-hs-input-number-input="">
                        <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" tabindex="-1" aria-label="Increase" data-hs-input-number-increment="">
                            <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M5 12h14"></path>
                                <path d="M12 5v14"></path>
                            </svg>
                        </button>
                    </div>
                </div>
                <!-- End Input Number -->
            </div>
        </div>
    </div>

    {{-- Actions --}}
    <div class="flex flex-col flex-grow gap-4 my-4 lg:flex-row" wire:ignore>
        <x-primary-button wire:click.prevent="donate" class="flex-1 w-full lg:w-auto">تبرع الان</x-primary-button>
        <x-primary-button wire:click.prevent="addToCart" class="flex-1 w-full lg:w-auto">أضف إلي السلة</x-primary-button>
    </div>
    <div>
        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
        <x-input-error class="mt-2" :messages="$errors->get('misc_donation_id')" />
    </div>
</div>
