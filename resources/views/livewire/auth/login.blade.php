<div>
    <form wire:submit.prevent="submit">
        <div class="mt-3">
            <div class="flex items-center gap-2 border-b-2 border-gray-300 ps-2">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.0284 0.0929697L11.1213 1.00856C11.8524 1.58796 13.3293 4.50642 9.32682 10.1359C5.46466 15.5651 2.3262 15.1788 1.52866 14.814L0.258509 14.1559C-0.00733761 13.9842 -0.0737991 13.648 0.103432 13.3977L2.37789 10.1216C2.43697 10.0429 2.5182 9.97852 2.60682 9.9356C2.77666 9.85692 2.98343 9.85692 3.16066 9.97137L4.29051 10.8369C4.85912 11.1445 5.44251 10.5794 5.9742 9.95706L7.91635 7.16736C8.59574 5.92273 8.89112 5.2718 8.43328 4.89268L7.11882 4.27752C6.86774 4.10585 6.79389 3.7768 6.97112 3.51929L9.24559 0.243184C9.40805 0.00713278 9.76251 -0.0858572 10.0284 0.0929697Z" fill="#979797" />
                </svg>
                <x-auth-input wire:model='phone_number' id="phone_number" class="block w-full" type="tel" name="phone_number" placeholder="{{ __('messages.Phone number') }}" :value="old('phone_number')" required autofocus autocomplete="phone_number" />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>
        <div class="mt-3">
            <div class="flex items-center gap-2 border-b-2 border-gray-300 ps-2">
                <svg width="12" height="15" viewBox="0 0 12 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M10.3086 5.98321H9.98457V3.91533C9.98457 1.75647 8.19703 0 6 0C3.80297 0 2.01543 1.75647 2.01543 3.91533V5.98321H1.69139C0.754896 5.98321 0 6.58502 0 7.3268V13.6564C0 14.3982 0.754896 15 1.69139 15H10.3086C11.2451 15 12 14.3982 12 13.6564V7.3268C12 6.58502 11.2451 5.98321 10.3086 5.98321ZM3.43976 3.91533C3.43976 2.52624 4.58991 1.39958 6 1.39958C7.41009 1.39958 8.56024 2.52624 8.56024 3.91533V5.98321H3.43976V3.91533Z" fill="#979797" />
                </svg>

                <x-auth-input wire:model="password" id="password" class="block w-full" type="password" name="password" placeholder="{{ __('messages.Password') }}" :value="old('password')" required />
            </div>
            <x-input-error class="mt-2" :messages="$errors->get('password')" />
        </div>

        <div class="flex items-center justify-center mt-4">
            <x-primary-button wire:click.prevent="submit" wire:loading.attr="disabled" class="px-5 py-3 mt-7">
                {{ __('messages.Login') }}
            </x-primary-button>
        </div>
        <div class="my-5 text-center">
            <a href="{{ route('forgot-password') }}">{{ __('messages.Forgot your password?') }}</a>
        </div>
    </form>
</div>
