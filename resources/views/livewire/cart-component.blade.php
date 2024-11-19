@use('App\Enums\PaymentMethodEnum', 'PaymentMethodEnum')
<div>

    <div x-data="{ isOpen: false }">
        <!-- Cart button -->
        <button @click="isOpen = !isOpen" class="relative flex items-center justify-center w-10 h-10 bg-gray-100 rounded-lg hover:bg-gray-200" wire:loading.attr='disabled'>
            <svg width="28px" height="28px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M6.29977 5H21L19 12H7.37671M20 16H8L6 3H3M9 20C9 20.5523 8.55228 21 8 21C7.44772 21 7 20.5523 7 20C7 19.4477 7.44772 19 8 19C8.55228 19 9 19.4477 9 20ZM20 20C20 20.5523 19.5523 21 19 21C18.4477 21 18 20.5523 18 20C18 19.4477 18.4477 19 19 19C19.5523 19 20 19.4477 20 20Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
            </svg>

            @if ($cartItems->count() !== 0)
                <span class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 transform translate-x-1/2 -translate-y-1/2 bg-red-600 rounded-full">
                    {{ $cartItems->count() }}
                </span>
            @endif
        </button>

        <!-- Slide-over cart -->
        <div x-cloak x-show="isOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="transform opacity-0" x-transition:enter-end="transform opacity-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="transform opacity-100" x-transition:leave-end="transform opacity-0" class="fixed inset-y-0 left-0 z-50 w-full px-6 py-6 overflow-y-auto bg-white sm:max-w-2xl sm:ring-1 sm:ring-gray-900/10">
            <div class="flex items-start justify-between pb-3 mb-3 truncate border-b border-gray-200">
                <button @click="isOpen = false" class="-m-2.5 rounded-md p-2.5 text-gray-700" wire:loading.attr='disabled'>
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
                <x-danger-button wire:loading.attr='disabled' wire:click="clearCart">
                    مسح السلة
                </x-danger-button>
            </div>
            <div class="mt-6">
                @foreach ($cartItems as $item)
                    <div class="flex justify-between pb-2 mb-4 border-b border-gray-200">
                        <span>{{ $item->cartable->title }}</span>
                        <span>{{ $item->amount }} دينار كويتي</span>

                        <x-danger-button wire:loading.attr='disabled' wire:click="removeFromCart({{ $item->id }})" class="text-sm text-red-600 hover:text-red-900">
                            حذف
                        </x-danger-button>
                    </div>
                @endforeach
                @if ($cartItems->isEmpty())
                    <div class="text-center">
                        لا يوجد عناصر في السلة
                    </div>
                @else
                    <div class="flex justify-between w-full">
                        <div class="flex items-center justify-start w-full mx-auto gap-x-3">
                            <h2 class="font-bold text-gray-600">
                                طريقة الدفع
                            </h2>
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
                        <x-primary-button wire:loading.attr='disabled' wire:click="checkout" class="text-nowrap">
                            الذهاب للدفع
                        </x-primary-button>
                    </div>
                    <div class='flex-grow col-span-full'>
                        <x-input-error :messages="$errors->get('paymentMethodId')" class="mt-2" />
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
