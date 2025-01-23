<div>
    <div class="container">
        <div class="max-w-2xl p-4 mx-auto my-12 bg-white shadow sm:p-8 sm:rounded-lg">
            
                <div class="mb-4 text-sm text-gray-600">
                    <h1 class="text-xl font-bold text-center">{{__("messages.Forgot password")}}</h1>
                    <p class="text-lg">
                        {{ __('messages.Enter your registered phone number to receive a link to reset your password and regain access to your account.') }}
                    </p>
                </div>
                <div>
                    <div class="mb-3">
                        <div class="flex-grow w-full">
                            <div class="flex gap-x-3">
                                <x-text-input id="phone_number" minlength="8" maxlength="12" wire:model="phoneNumber" class="block w-full text-end" type="tel" name="phone_number" placeholder="رقم الهاتف" :value="old('phone_number')" required autocomplete="phone_number" />
                                <select wire:model="countryCode" class="appearance-none py-2 pe-4 flex gap-x-2 text-nowrap max-w-[120px]  min-w-[40px] lg:min-w-[80px] cursor-pointer bg-white border border-gray-200 rounded-lg text-start focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    <option selected>--@lang('messages.Country')--</option>
                                    @foreach ($countries as $country)
                                        <option value="{{ $country->code }}">(+{{ $country->code }})</option>
                                    @endforeach
                                </select>
                            </div>
                            <x-input-error class="mt-2" :messages="$errors->get('phoneNumber')" />
                            <x-input-error class="mt-2" :messages="$errors->get('countryCode')" />
                        </div>
                    </div>
                    <div class="text-center">
                        <x-primary-button wire:click.prevent="submit" wire:loading.attr="disabled">
                            @lang('messages.Submit')
                        </x-primary-button>
                    </div>
                </div>
        </div>
    </div>
</div>
