@use('App\Models\Category', 'Category')
@use('App\Settings\GeneralSettings', 'GeneralSettings')
<div class="relative p-2 text-white" style="background: linear-gradient(270deg, #0072BB 0%, #2E3192 100%);">
    <div class="absolute top-0 z-0 hidden -translate-x-1/3 left-1/2 lg:block">
        <svg width="372" height="37" viewBox="0 0 372 37" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path opacity="0.2" d="M-4.48767 -46.8023V-1.77762C23.7896 10.6924 53.4713 19.4189 83.8694 26.6065C189.695 51.6358 279.789 100.716 337.802 196.717C351.116 218.748 361.31 242.229 367.062 267.456C367.34 268.692 367.961 269.852 368.93 271.926C369.214 272.531 369.528 273.213 369.87 274C369.963 273.309 370.053 272.617 370.139 271.926C376.821 218.685 363.69 171.78 336.603 128.772C325.03 110.399 308.924 94.9145 295.687 77.5094C261.988 33.1952 232.863 -13.6869 216.463 -67.4221C216.056 -68.7443 215.263 -69.9518 213.376 -71C208.949 -27.7181 221.67 13.7 228.183 57.3419C205.36 40.1247 180.658 29.1235 156.21 17.6029C119.43 0.277359 80.3731 -11.0776 42.6018 -25.7714C26.4255 -32.067 10.7034 -39.0443 -4.48767 -46.8023Z" fill="white" />
        </svg>

    </div>


    <div class="container relative z-10 mx-auto">
        <div class="flex justify-between">
            <div id="header-contact" class="text-sm">
                <a href="{{ app(GeneralSettings::class)->header_url }}" target="_blank" class="flex items-center gap-x-2">
                    <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.00313 0C3.13545 0 0 3.10629 0 6.938C0 8.23384 0.356728 9.44287 0.982566 10.4783L0.100134 14.0062L3.61109 13.008C4.61869 13.5598 5.77023 13.876 7.00313 13.876C10.8708 13.876 14.0063 10.7697 14.0063 6.938C14 3.10629 10.8708 0 7.00313 0ZM7.07823 12.7228C5.85785 12.7228 4.71882 12.3446 3.78632 11.7059L1.7899 12.2764L2.30308 10.2365C1.65221 9.30647 1.27045 8.17803 1.27045 6.9628C1.27045 3.78211 3.87394 1.20283 7.08449 1.20283C10.295 1.20283 12.8985 3.78211 12.8985 6.9628C12.8923 10.1435 10.2888 12.7228 7.07823 12.7228Z" fill="white" />
                        <path d="M5.23185 6.38613C5.31321 6.29312 5.39457 6.20012 5.47593 6.10712C5.61361 5.95211 5.81388 5.79711 5.8264 5.5739C5.83265 5.3569 5.75755 5.14609 5.68245 4.94768C5.63239 4.81748 5.58232 4.69348 5.53225 4.56947C5.44463 4.33387 5.32572 4.01146 5.20056 3.87505C5.02532 3.69525 4.72492 3.65805 4.49336 3.76965C4.49336 3.76965 3.11652 4.42067 3.54209 5.73511C3.54209 5.73511 4.36193 9.42421 8.47995 10.1868C8.47995 10.1868 9.95693 10.3976 10.3575 9.50481C10.4451 9.31261 10.5014 9.0398 10.4889 8.8352C10.4764 8.63059 10.3324 8.50039 10.1635 8.40118C9.94441 8.27718 9.7504 8.16558 9.50632 8.04157C9.29354 7.93617 9.0432 7.78117 8.79913 7.84937C8.61763 7.89897 8.48621 8.06017 8.3673 8.19038C8.20458 8.35778 8.04186 8.52519 7.87914 8.69259C7.87289 8.68639 5.78259 7.92997 5.23185 6.38613Z" fill="white" />
                    </svg>

                    {{ app(GeneralSettings::class)->header_text }}
                </a>
            </div>
            <div id="gregorian-clock" class="text-xs md:text-sm">
            </div>
        </div>
    </div>
</div>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-md">
    <!-- Primary Navigation Menu -->
    <div class="container px-4 mx-auto sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block w-auto text-gray-800 fill-current h-9" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="items-center hidden sm:-my-px sm:flex gap-x-3">
                        {{-- <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            الرئيسية
                        </x-nav-link> --}}
                        @foreach (Category::navbarCategories()->get() as $category)
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 font-bold leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md text-md hover:text-gray-700 focus:outline-none">
                                        <div class="flex items-center text-md text-nowrap gap-x-3">
                                            {{ $category->name }}
                                            <svg fill="#000000" class="w-4 h-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                            </svg>
                                        </div>
                                    </button>
                                </x-slot>

                                <x-slot name="content">
                                    @forelse ($category->children as $subcategory)
                                        <x-dropdown-link :href="route('projects.list', $subcategory)">
                                            {{ $subcategory->name }}
                                        </x-dropdown-link>
                                    @empty
                                        <p class="p-3 text-center">لا يوجد فئات</p>
                                    @endforelse
                                </x-slot>
                            </x-dropdown>
                        @endforeach
                        <x-nav-link :href="route('about')" :active="request()->routeIs('about')">
                            من نحن
                        </x-nav-link>
                        <x-nav-link :href="route('galleries.list')" :active="request()->routeIs('galleries.view')">
                            المركز الإعلامي
                        </x-nav-link>
                        {{-- <x-nav-link :href="route('articles.list')" :active="request()->routeIs('articles.list')">
                            أخبار الجمعية
                        </x-nav-link> --}}
                        <x-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                            تواصل معنا
                        </x-nav-link>
                    </div>
                </div>
                @guest
                    <div>
                        <livewire:auth>
                    </div>
                @endguest
            </div>

            <div class="flex items-center">
                <livewire:cart-component />
            </div>
            @auth
                @role('user')
                    <!-- Settings Dropdown -->
                    <div class="hidden sm:flex sm:items-center">
                        <x-dropdown align="right" width="48">
                            <x-slot name="trigger">
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md hover:text-gray-700 focus:outline-none">
                                    <div class="flex items-center text-nowrap gap-x-3">
                                        <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M16.2018 6.39222C16.2018 9.55933 13.8225 12.0344 10.9974 12.0344C8.17229 12.0344 5.79297 9.55933 5.79297 6.39222C5.79297 3.2251 8.17229 0.75 10.9974 0.75C13.8225 0.75 16.2018 3.2251 16.2018 6.39222Z" stroke="#3F3F3F" stroke-width="1.5" />
                                            <path d="M0.773082 24.2501C1.13144 18.4496 5.61632 13.9443 10.9972 13.9443C16.378 13.9443 20.8629 18.4496 21.2212 24.2501H10.9972H0.773082Z" stroke="#3F3F3F" stroke-width="1.5" />
                                        </svg>
                                        {{ Auth::user()->name }}
                                    </div>
                                </button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('profile.edit')">
                                    الحساب
                                </x-dropdown-link>
                                <x-dropdown-link :href="route('profile.edit')">
                                    الملف الشخصي
                                </x-dropdown-link>

                                <!-- Authentication -->
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf

                                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                        تسجيل الخروج
                                    </x-dropdown-link>
                                </form>
                            </x-slot>
                        </x-dropdown>
                    </div>
                @else
                    <div class="flex items-center ms-3">
                        <a class="items-center" href="{{ route('filament.admin.pages.dashboard') }}">Admin</a>
                    </div>
                @endrole
            @else
            @endauth

            <!-- Hamburger -->
            <div class="flex items-center -me-2 ms-3 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500">
                    <svg class="w-6 h-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{ 'block': open, 'hidden': !open }" class="hidden sm:hidden">
        <div class="w-full pt-2 pb-3 space-y-1">
            @foreach (Category::navbarCategories()->get() as $category)
                <x-dropdown align="right" width="w-full">
                    <x-slot name="trigger" class="w-full">
                        <button class="inline-flex items-center px-3 py-2 font-bold leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md text-md hover:text-gray-700 focus:outline-none">
                            <div class="flex items-center text-md text-nowrap gap-x-3">
                                {{ $category->name }}
                                <svg fill="#000000" class="w-4 h-4" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content" class="w-full">
                        @forelse ($category->children as $subcategory)
                            <x-dropdown-link :href="route('projects.list', $subcategory)">
                                {{ $subcategory->name }}
                            </x-dropdown-link>
                        @empty
                            <p class="p-3 text-center">لا يوجد فئات</p>
                        @endforelse
                    </x-slot>
                </x-dropdown>
            @endforeach
            <x-responsive-nav-link :href="route('about')" :active="request()->routeIs('about')">
                من نحن
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('galleries.list')" :active="request()->routeIs('galleries.view')">
                المركز الإعلامي
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('contact')" :active="request()->routeIs('contact')">
                تواصل معنا
            </x-responsive-nav-link>
            {{-- <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link> --}}
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800">
                        <svg width="22" height="25" viewBox="0 0 22 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M16.2018 6.39222C16.2018 9.55933 13.8225 12.0344 10.9974 12.0344C8.17229 12.0344 5.79297 9.55933 5.79297 6.39222C5.79297 3.2251 8.17229 0.75 10.9974 0.75C13.8225 0.75 16.2018 3.2251 16.2018 6.39222Z" stroke="#3F3F3F" stroke-width="1.5" />
                            <path d="M0.773082 24.2501C1.13144 18.4496 5.61632 13.9443 10.9972 13.9443C16.378 13.9443 20.8629 18.4496 21.2212 24.2501H10.9972H0.773082Z" stroke="#3F3F3F" stroke-width="1.5" />
                        </svg>

                        {{ Auth::user()->name }}
                    </div>
                    <div class="text-sm font-medium text-gray-500">{{ Auth::user()->email }}</div>
                </div>

                <div class="mt-3 space-y-1">
                    <x-responsive-nav-link :href="route('profile.edit')">
                        {{ __('messages.Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('messages.Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
        @endauth
    </div>
</nav>
