<div>


    {{-- Donations details --}}
    <div id="donationsDetails" class="flex flex-grow gap-3">
        <div class="flex-1 border border-blue-600 rounded-md">
            <h5 class="px-2 py-2 text-sm font-bold text-center text-white bg-blue-600">قيمة المشروع</h5>
            <div class="p-2 text-center">
                <span>{{ $requiredDonationValue }} د.ك</span>
            </div>
        </div>
        <div class="flex-1 border border-green-600 rounded-md">
            <h5 class="px-2 py-2 text-sm font-bold text-center text-white bg-green-600">المدفوع</h5>
            <div class="p-2 text-center">
                <span>{{ $donationsAmount }} د.ك</span>
            </div>
        </div>
        <div class="flex-1 border border-red-600 rounded-md">
            <h5 class="px-2 py-2 text-sm font-bold text-center text-white bg-red-600">المتبقي</h5>
            <div class="p-2 text-center">
                <span>{{ $remainingAmount }} د.ك</span>
            </div>
        </div>
    </div>

    {{-- Donation progress bar --}}
    <div class="my-3">
        <p class="text-end">{{ number_format($donationsPercentage, 2) }} ٪</p>
        <!-- Progress -->
        <div class="flex w-full h-1.5 bg-gray-200 rounded-full overflow-hidden dark:bg-neutral-700" role="progressbar" aria-valuenow="{{ $donationsPercentage }}" aria-valuemin="0" aria-valuemax="100">
            <div class="flex flex-col justify-center overflow-hidden text-xs text-center text-white transition duration-500 bg-yellow-500 rounded-full whitespace-nowrap dark:bg-yellow-500" style="width: {{ $donationsPercentage < 1 ? 1 : $donationsPercentage }}%"></div>
        </div>
        <!-- End Progress -->
    </div>

    {{-- Make donation  --}}
    <div class="flex items-center justify-between gap-4 mt-5">
        <div>أدخل المبلغ بالدينار</div>
        <!-- Input Number -->
        <div class="inline-block px-3 py-2 bg-white border border-gray-200 rounded-lg" data-hs-input-number="">
            <div class="flex items-center gap-x-1.5">
                <button type="button" class="inline-flex items-center justify-center text-sm font-medium text-gray-800 bg-white border border-gray-200 rounded-md shadow-sm size-6 gap-x-2 hover:bg-gray-50 focus:outline-none focus:bg-gray-50 disabled:opacity-50 disabled:pointer-events-none" tabindex="-1" aria-label="Decrease" data-hs-input-number-decrement="">
                    <svg class="shrink-0 size-3.5" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M5 12h14"></path>
                    </svg>
                </button>
                <input wire:model="amount" class="min-w-24 p-0 w-6 bg-transparent border-0 text-gray-800 text-center focus:ring-0 [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none --prevent-on-load-init" style="-moz-appearance: textfield;" type="number" aria-roledescription="Number field" value="0" data-hs-input-number-input="">
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

    {{-- Quick donation --}}
    <div class="flex flex-wrap items-center justify-center w-full gap-3 mt-4">
        @forelse($project->quickDonationValues as $quickDonation)
            <button type="button" wire:click.prevent="$set('amount', {{ $quickDonation->amount }})" class="inline-flex p-2 border border-gray-400 rounded-3xl {{ $amount == $quickDonation->amount ? 'bg-green-500 border-green-500 text-white' : '' }}" wire:click="$set('amount', {{ $quickDonation->amount }}}">{{ $quickDonation->amount }}</button>
        @empty
        @endforelse
    </div>

    @if ($showPhoneNumber)
        <div>
            <div class="flex items-center justify-between gap-4 mt-4">
                <span class="font-bold text-nowrap">رقم الهاتف</span>
                <x-text-input wire:model="phone_number" type="text" class="w-full" placeholder="رقم الهاتف" />
                <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
            </div>
        </div>
    @endif
    {{-- @endif --}}
    {{-- Actions --}}
    <div class="flex flex-col flex-grow gap-4 my-4 lg:flex-row" wire:ignore>
        @role('user')
            <x-primary-button wire:click.prevent="donate" class="flex-1 w-full lg:w-auto">تبرع الان</x-primary-button>
        @else
            @if (request()->routeIs('projects.view'))
                <x-primary-button wire:click.prevent="donate" class="flex-1 w-full lg:w-auto">تبرع الان</x-primary-button>
            @else
                <x-primary-button href="{{ route('projects.view', $project) }}" class="flex-1 w-full lg:w-auto">تبرع الان</x-primary-button>
            @endif
        @endrole
        <x-primary-button wire:click.prevent="addToCart" class="flex-1 w-full lg:w-auto">أضف إلي السلة</x-primary-button>
    </div>
    <div>
        <x-input-error class="mt-2" :messages="$errors->get('amount')" />
    </div>

</div>
