<div>
    <div x-data="{ showModal: false }" x-on:show-auth-modal.window="showModal = $event.detail" class="flex items-center justify-between">
        <button type="button" wire:loading.attr="disabled" @click="showModal = true" class="px-4 py-2 text-white">
            <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path class="stroke-gray-900" d="M16.2018 6.39222C16.2018 9.55933 13.8225 12.0344 10.9974 12.0344C8.17229 12.0344 5.79297 9.55933 5.79297 6.39222C5.79297 3.2251 8.17229 0.75 10.9974 0.75C13.8225 0.75 16.2018 3.2251 16.2018 6.39222Z" stroke-width="1.5" />
                <path class="stroke-gray-900" d="M0.773082 24.2501C1.13144 18.4496 5.61632 13.9443 10.9972 13.9443C16.378 13.9443 20.8629 18.4496 21.2212 24.2501H10.9972H0.773082Z" stroke-width="1.5" />
            </svg>
        </button>
        <div x-show="showModal" x-cloak x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center px-5 bg-black bg-opacity-50 lg:px-0">
            <div class="relative w-full max-w-md p-10 mx-auto bg-white rounded-lg shadow-lg">
                <div class="absolute top-4 left-4 hover:text-blue-500">
                    <button type="button" @click="showModal = false">
                        <svg class="hover:text-blue-500" width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M8.2325 7.00116L8.23499 6.99867L8.2325 6.99618L13.7433 1.48737C14.0847 1.14603 14.0847 0.595395 13.7433 0.254053C13.4018 -0.0872886 12.851 -0.0872886 12.5095 0.254053L6.99874 5.76286L1.49046 0.254053C1.31848 0.0846281 1.09666 -8.44593e-05 0.872339 -8.44593e-05C0.64802 -8.44593e-05 0.426193 0.0846281 0.256708 0.254053C-0.0847555 0.595395 -0.0847555 1.14603 0.256708 1.48737L5.76748 6.99618L5.76499 6.99867L5.76748 7.00116L0.256708 12.51C-0.0847555 12.8513 -0.0847555 13.4019 0.256708 13.7433C0.598171 14.0846 1.149 14.0846 1.49046 13.7433L7.00123 8.23448L12.512 13.7433C12.6815 13.9127 12.9058 13.9974 13.1276 13.9974C13.3495 13.9974 13.5738 13.9127 13.7458 13.7408C14.0872 13.3995 14.0872 12.8488 13.7458 12.5075L8.2325 7.00116Z" fill="#979797" />
                        </svg>
                    </button>
                </div>
                <div class="px-6 pb-5 mt-8 border border-blue-600 rounded-xl">
                    {{-- Tabs --}}
                    <div class="relative flex items-center justify-center px-2 py-2 mx-auto bg-gray-100 rounded-3xl gap-x-1 w-fit -top-5">
                        <button wire:click.prevent="$set('activeTab', 'loginTab' )" type="button" class="px-5 py-1 rounded-2xl {{ $activeTab == 'loginTab' ? 'bg-blue-600 text-white' : 'bg-transparent text-gray-700' }}">
                            @lang('messages.Login')
                        </button>
                        <button wire:click.prevent="$set('activeTab', 'registerTab' )" type="button" class="px-5 py-1 rounded-2xl {{ $activeTab == 'registerTab' ? 'bg-blue-600 text-white' : 'bg-transparent text-gray-700' }}"">
                            @lang('messages.Create new account')
                        </button>
                    </div>

                    <div>
                        @if ($activeTab == 'loginTab')
                            @livewire('auth.login')
                        @elseif($activeTab == 'registerTab')
                            @livewire('auth.register')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
