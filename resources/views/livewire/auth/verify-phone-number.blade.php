<div>
    <div class="container">
        <div class="max-w-xl p-4 mx-auto my-12 bg-white shadow sm:p-8 sm:rounded-lg">
            @if (!$phoneNumberVerified)
                <div class="mb-4 text-sm text-gray-600">
                    <p class="text-lg">
                        {{ __('messages.Thanks for signing up! Before getting started, could you verify your phone number by your WhatsApp.') }}
                    </p>
                </div>
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-sm font-medium text-[#07A54F]">
                        {{ __('messages.A new OTP has been sent to your WhatsApp.') }}
                    </div>
                @endif

                <div>
                    <div class="mb-3">
                        <x-input-label for="otp" :value="__('OTP')" />

                        <x-text-input wire:model="otp" id="otp" class="block w-full mt-1" type="text" name="otp" required autocomplete="otp" />

                        <x-input-error :messages="$errors->get('otp')" class="mt-2" />
                    </div>
                    <div class="text-center">
                        <x-primary-button wire:click.prevent="submit" wire:loading.attr="disabled">
                            @lang('messages.Submit')
                        </x-primary-button>
                    </div>
                </div>
            @else
                {{-- Thanks for verifying your phone number --}}
                <div class="mb-4 text-center text-gray-600">
                    <p class="text-lg text-center">
                        {{ __('messages.Thanks for verifying your phone number') }}
                    </p>
                    <a href="{{ route('home') }}">
                        <x-primary-button class="mt-4">
                            {{ __('messages.Go to home') }}
                        </x-primary-button>
                    </a>
                </div>
            @endif
        </div>
    </div>
</div>
