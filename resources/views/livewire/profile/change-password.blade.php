<div>
    <div class="flex flex-col w-full p-4 bg-white rounded-xl md:p-5 ">
        <div class="">
            <h1 class="mb-6 text-lg font-bold">
                تغيير كلمة المرور
            </h1>
        </div>
        <form wire:submit.prevent="submit" class="max-w-lg py-4">
            {{-- <div class="flex flex-col mb-3 space-y-4"> --}}
            <div class="flex items-center mb-3 ">
                <x-input-label class="w-32" for="name" value="كلمة المرور الجديدة" />
                <div class="flex-grow">
                    <x-text-input id="password" wire:model="password" class="block w-full" type="password" name="password" placeholder="كلمة المرور الجديدة" required autofocus />
                    <x-input-error class="mt-2" :messages="$errors->get('password')" />
                </div>
            </div>
            <div class="flex items-center mb-3 ">
                <x-input-label class="w-32" for="password_confirmation" value="تأكيد كلمة المرور" />
                <div class="flex-grow">
                    <x-text-input id="password_confirmation" minlength="8" maxlength="20" wire:model="password_confirmation" class="block w-full" type="password" name="password_confirmation" placeholder="تأكيد كلمة المرور" required />
                    <x-input-error class="mt-2" :messages="$errors->get('password_confirmation')" />
                </div>
            </div>
            {{-- </div> --}}
            <x-primary-button class="w-full" wire:click.prevent="submit" wire:loading.attr="disabled">تغيير كلمة المرور</x-primary-button>
        </form>
    </div>
</div>
