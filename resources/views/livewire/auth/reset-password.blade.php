<div>
    <div class="container">
        <div class="max-w-2xl p-4 mx-auto my-12 bg-white shadow sm:p-8 sm:rounded-lg">
            
                <div class="mb-4 text-sm text-gray-600">
                    <h1 class="text-xl font-bold text-center">{{__("messages.Reset password")}}</h1>
                    <p class="text-lg">
                        {{ __('messages.Set your new password') }}
                    </p>
                </div>
                <div>
                    <div class="mb-3">
                        <x-text-input id="new_password" wire:model="newPassword" class="block w-full" type="password" name="newPassword" placeholder="{{__('messages.New password')}}"  required />
                        <x-input-error class="mt-2" :messages="$errors->get('newPassword')" />
                    </div>
                    <div class="mb-3">
                        <x-text-input id="new_password" wire:model="confirmPassword" class="block w-full" type="password" name="confirmPassword" placeholder="{{__('messages.Confirm password')}}"  required />
                        <x-input-error class="mt-2" :messages="$errors->get('confirmPassword')" />
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
