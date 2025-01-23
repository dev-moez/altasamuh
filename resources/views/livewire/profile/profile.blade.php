<div>
    <div class="flex flex-col w-full p-4 mt-5 bg-white lg:mt-0 rounded-xl md:p-5">
        <div class="">
            <h1 class="mb-6 text-lg font-bold">
                ملفي الشخصي
            </h1>
        </div>
        <form wire:submit.prevent="submit" class="w-full py-4 lg:max-w-2xl">
            {{-- <div class="flex flex-col mb-3 space-y-4"> --}}
            <div class="flex flex-col items-center w-full mb-3 lg:flex-row">
                <x-input-label class="mb-3 lg:mb-0 w-full lg:w-[100px]" for="name" value="{{ __('messages.Name') }}" />
                <div class="flex-grow w-full">
                    <x-text-input id="name" wire:model="name" class="block w-full" type="text" name="name" placeholder="{{ __('messages.Name') }}" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
            </div>
            <div class="flex flex-col items-center w-full mb-3 lg:flex-row">
                <x-input-label class="mb-3 lg:mb-0 w-full lg:w-[100px]" for="name" value="رقم الهاتف" />
                <div class="flex-grow w-full">
                    <div class="flex gap-x-3">
                        <x-text-input id="phone_number" minlength="8" maxlength="12" wire:model="phone_number" class="block w-full text-end" type="tel" name="phone_number" placeholder="رقم الهاتف" :value="old('phone_number')" required autocomplete="phone_number" />
                        <select wire:model="country_code" class="appearance-none py-2 pe-4 flex gap-x-2 text-nowrap max-w-[120px]  min-w-[40px] lg:min-w-[80px] cursor-pointer bg-white border border-gray-200 rounded-lg text-start focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <option selected>--@lang('messages.Country')--</option>
                            @foreach ($countries as $country)
                                <option value="{{ $country->code }}">(+{{ $country->code }})</option>
                            @endforeach
                        </select>
                    </div>
                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                    <x-input-error class="mt-2" :messages="$errors->get('country_code')" />
                </div>
            </div>
            <x-primary-button class="w-full" wire:click.prevent="submit" wire:loading.attr="disabled">تحديث</x-primary-button>
        </form>
    </div>
</div>
