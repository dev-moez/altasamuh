@use('App\Enums\PaymentMethodEnum', 'PaymentMethodEnum')
<div>

    <div x-data="{ isOpen: false }">
        <!-- Cart button -->
        <button @click="isOpen = !isOpen" class="relative flex items-center justify-center w-10 h-10 rounded-lg hover:bg-gray-200" wire:loading.attr='disabled'>
            <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M1.37096 0.00290613C0.922263 0.00290613 0.560059 0.391947 0.560059 0.873894C0.560059 1.35584 0.922263 1.74488 1.37096 1.74488H3.95505L6.74187 15.8723C6.85269 16.4036 7.17705 16.8478 7.58791 16.842H21.103C21.5301 16.8478 21.9247 16.4326 21.9247 15.971C21.9247 15.5094 21.5301 15.0942 21.103 15.1H8.24745L7.90146 13.3581H22.1842C22.5464 13.3552 22.8897 13.059 22.9708 12.6787L24.8629 3.96881C24.9683 3.46364 24.5602 2.91201 24.0763 2.9062H5.84717L5.40657 0.690985C5.33089 0.304847 4.9795 0 4.61189 0H1.37096V0.00290613ZM6.18504 4.64817H23.0546L21.5436 11.6161H7.56358L6.18504 4.64817ZM10.2909 17.4227C8.80697 17.4227 7.58791 18.732 7.58791 20.326C7.58791 21.9199 8.80697 23.2292 10.2909 23.2292C11.7749 23.2292 12.9939 21.9199 12.9939 20.326C12.9939 18.732 11.7749 17.4227 10.2909 17.4227ZM18.4 17.4227C16.916 17.4227 15.697 18.732 15.697 20.326C15.697 21.9199 16.916 23.2292 18.4 23.2292C19.8839 23.2292 21.103 21.9199 21.103 20.326C21.103 18.732 19.8839 17.4227 18.4 17.4227ZM10.2909 19.1646C10.8964 19.1646 11.3721 19.6756 11.3721 20.326C11.3721 20.9763 10.8964 21.4873 10.2909 21.4873C9.68545 21.4873 9.20972 20.9763 9.20972 20.326C9.20972 19.6756 9.68545 19.1646 10.2909 19.1646ZM18.4 19.1646C19.0055 19.1646 19.4812 19.6756 19.4812 20.326C19.4812 20.9763 19.0055 21.4873 18.4 21.4873C17.7945 21.4873 17.3188 20.9763 17.3188 20.326C17.3188 19.6756 17.7945 19.1646 18.4 19.1646Z" fill="#3F3F3F" />
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
                    <div class="flex items-center justify-between pb-2 mb-4 text-sm border-b border-gray-200 lg:text-md">
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
                    <div class="flex flex-col justify-between w-full lg:flex-row">
                        <div class="flex items-center justify-start w-full mx-auto gap-x-3">
                            <h2 class="font-bold text-gray-600 text-nowrap">
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
                        <x-primary-button wire:loading.attr='disabled' wire:click="checkout" class="mt-3 text-nowrap col-span-full lg:mt-0">
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
