@use('App\Models\Category', 'Category')
@use('App\Settings\GeneralSettings', 'GeneralSettings')
<div class="relative p-2 text-white bg-transparent bg-center bg-no-repeat bg-cover">
    <div class="absolute top-0 left-0 right-0 -z-1">
        <svg class="w-full h-full" viewBox="0 0 1440 37" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="1440" height="50" fill="url(#paint0_linear_0_1)" />
            <g clip-path="url(#clip0_0_1)">
                <path opacity="0.2" d="M527.512 -46.8023V-1.77762C555.789 10.6924 585.471 19.4189 615.869 26.6065C721.695 51.6358 811.789 100.716 869.802 196.717C883.115 218.748 893.31 242.229 899.061 267.456C899.34 268.692 899.96 269.852 900.93 271.926C901.214 272.531 901.528 273.213 901.87 274C901.963 273.309 902.052 272.617 902.139 271.926C908.821 218.685 895.69 171.78 868.603 128.772C857.029 110.399 840.923 94.9145 827.687 77.5094C793.988 33.1952 764.863 -13.6869 748.462 -67.4221C748.056 -68.7443 747.263 -69.9518 745.375 -71C740.948 -27.7181 753.67 13.7 760.183 57.3419C737.359 40.1247 712.658 29.1235 688.21 17.6029C651.43 0.277359 612.373 -11.0776 574.602 -25.7714C558.425 -32.067 542.703 -39.0443 527.512 -46.8023Z" fill="white" />
            </g>
            <defs>
                <linearGradient id="paint0_linear_0_1" x1="1440" y1="18.5" x2="0" y2="18.5" gradientUnits="userSpaceOnUse">
                    <stop stop-color="#0072BB" />
                    <stop offset="1" stop-color="#2E3192" />
                </linearGradient>
                <clipPath id="clip0_0_1">
                    <rect width="452" height="50" fill="white" transform="matrix(-1 0 0 1 984 0)" />
                </clipPath>
            </defs>
        </svg>
    </div>


    <div class="container z-10 mx-auto">
        <div class="flex justify-between">
            <div id="header-contact">
                <a href="{{ app(GeneralSettings::class)->header_url }}" target="_blank">
                    {{ app(GeneralSettings::class)->header_text }}
                </a>
            </div>
            <div id="hijri-clock">
            </div>
        </div>
    </div>
</div>
<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <!-- Primary Navigation Menu -->
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex items-center justify-between w-full">
                <div class="flex items-center justify-between">
                    <!-- Logo -->
                    <div class="flex items-center shrink-0">
                        <a href="{{ route('home') }}">
                            <x-application-logo class="block w-auto text-gray-800 fill-current h-9 dark:text-gray-200" />
                        </a>
                    </div>

                    <!-- Navigation Links -->
                    <div class="items-center hidden sm:-my-px sm:ms-10 sm:flex gap-x-3">
                        {{-- <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                            الرئيسية
                        </x-nav-link> --}}
                        @foreach (Category::navbarCategories()->get() as $category)
                            <x-dropdown align="right" width="48">
                                <x-slot name="trigger">
                                    <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
                                        <div class="flex items-center text-nowrap gap-x-3">
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
                                <button class="inline-flex items-center px-3 py-2 text-sm font-medium leading-4 text-gray-500 transition duration-150 ease-in-out bg-white border border-transparent rounded-md dark:text-gray-400 dark:bg-gray-800 hover:text-gray-700 dark:hover:text-gray-300 focus:outline-none">
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
            <div class="flex items-center -me-2 sm:hidden">
                <button @click="open = ! open" class="inline-flex items-center justify-center p-2 text-gray-400 transition duration-150 ease-in-out rounded-md dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-900 focus:outline-none focus:bg-gray-100 dark:focus:bg-gray-900 focus:text-gray-500 dark:focus:text-gray-400">
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
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        @auth
            <div class="pt-4 pb-1 border-t border-gray-200 dark:border-gray-600">
                <div class="px-4">
                    <div class="text-base font-medium text-gray-800 dark:text-gray-200">
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
                        {{ __('Profile') }}
                    </x-responsive-nav-link>

                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault();
                                        this.closest('form').submit();">
                            {{ __('Log Out') }}
                        </x-responsive-nav-link>
                    </form>
                </div>
            </div>
        @else
        @endauth
    </div>
</nav>
