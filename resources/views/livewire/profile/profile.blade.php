<div>
    <div class="flex flex-col w-full p-4 bg-white rounded-xl md:p-5 ">
        <div class="">
            <h1 class="mb-6 text-lg font-bold">
                ملفي الشخصي
            </h1>
        </div>
        <form wire:submit.prevent="submit" class="max-w-lg py-4">
            {{-- <div class="flex flex-col mb-3 space-y-4"> --}}
            <div class="flex items-center mb-3 ">
                <x-input-label class="w-32" for="name" value="{{ __('messages.Name') }}" />
                <div class="flex-grow">
                    <x-text-input id="name" wire:model="name" class="block w-full" type="text" name="name" placeholder="{{ __('messages.Name') }}" :value="old('name')" required autofocus autocomplete="name" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>
            </div>
            <div class="flex items-center mb-3 ">
                <x-input-label class="w-32" for="name" value="رقم الهاتف" />
                <div class="flex-grow">
                    <x-text-input id="phone_number" minlength="8" maxlength="11" wire:model="phone_number" class="block w-full text-end" type="tel" name="phone_number" placeholder="رقم الهاتف" :value="old('phone_number')" required autocomplete="phone_number" />
                    <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
                </div>
            </div>
            <x-primary-button class="w-full" wire:click.prevent="submit" wire:loading.attr="disabled">تحديث</x-primary-button>
        </form>
    </div>
</div>
