{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Altasamuh') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased rtl">
    <div class="bg-gray-100 dark:bg-gray-900">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main>
            <div class="container">
                <div class="flex flex-col py-12 lg:flex-row gap-x-5">
                    <div class="max-w-lg min-w-[320px] bg-white rounded-xl">
                        <div class="flex flex-col w-full rounded-lg">
                            <div class="flex items-start p-3 gap-x-3">
                                <div>
                                    أهلا٫
                                </div>
                                <div class="font-bold text-blue-700">
                                    <p>{{ auth()->user()->name }}</p>
                                    <p>{{ auth()->user()->phone_number }}</p>
                                </div>
                            </div>
                            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-800 bg-white border-b border-gray-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none hover:bg-gray-50">
                                حسابي الشخصي
                            </a>
                            <a href="{{ route('profile.edit') }}" class="flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-800 bg-white border-b border-gray-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none hover:bg-gray-50">
                                حسابي الخيري
                            </a>
                            <a href="{{ route('profile.change-password') }}" class="flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-800 bg-white border-b border-gray-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none hover:bg-gray-50">
                                تغيير كلمة المرور
                            </a>
                            <button type="button" class="inline-flex items-start text-sm font-medium text-gray-800 bg-white border-b border-gray-300 gap-x-2 focus:z-10 hover:bg-gray-50">
                                <form method="POST" action="{{ route('logout') }}" class="w-full text-start">
                                    @csrf

                                    <a class="block w-full px-4 py-3 text-start" href="route('logout')" onclick="event.preventDefault();
                                                    this.closest('form').submit();">
                                        تسجيل الخروج
                                    </a>
                                </form>
                            </button>
                        </div>
                    </div>
                    <div class="flex-grow">
                        {{ $slot }}
                    </div>
                </div>
            </div>
        </main>
    </div>
    <footer class="text-white bg-blue-500">
        <div class="">
            <div class="container flex flex-wrap justify-between grid-cols-1 px-4 py-8 mx-auto lg:gap-5 lg:grid-cols-3 grow-0">
                <div class="grow-0 lg:max-w-72">
                    <img src="{{ asset('images/logo-white.png') }}" alt="Al Tasamoh Logo" class="w-auto h-8 mb-3">
                    <div>
                        <p class="text-md">جمعية التسامح للأعمال الخيرية لتنمية المجتمع والمساهمة في إنماء المجتمع ومساعدة المحتاجين ومشاريع الأوقاف</p>
                    </div>
                </div>

                <nav class="flex flex-col gap-2">
                    <h5 class="font-bold">روابط هامة</h5>
                    <a href="{{ route('home') }}" class="hover:underline">الرئيسية</a>
                    <a href="{{ route('about') }}" class="hover:underline">من نحن</a>
                    <a href="{{ route('media') }}" class="hover:underline">المركز الإعلامي</a>
                    <a href="{{ route('contact') }}" class="hover:underline">تواصل معنا</a>
                </nav>

                <div class="flex flex-col items-center md:items-start">
                    <h3 class="mb-4 text-lg font-semibold">تواصل معنا</h3>
                    <div class="flex space-x-3 space-x-reverse">
                        <a href="#" class="text-white hover:text-gray-400">
                            <!-- X (Twitter) Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22.46 6c-.77.35-1.6.58-2.47.68a4.27 4.27 0 0 0 1.88-2.37 8.57 8.57 0 0 1-2.72 1.04 4.26 4.26 0 0 0-7.26 3.88A12.09 12.09 0 0 1 3.23 4.59a4.24 4.24 0 0 0 1.32 5.67 4.23 4.23 0 0 1-1.93-.54v.06a4.26 4.26 0 0 0 3.42 4.17 4.28 4.28 0 0 1-1.92.07 4.26 4.26 0 0 0 3.97 2.95A8.55 8.55 0 0 1 2 19.54a12.06 12.06 0 0 0 6.55 1.92c7.86 0 12.17-6.51 12.17-12.17 0-.19-.01-.39-.03-.58A8.68 8.68 0 0 0 24 4.59a8.65 8.65 0 0 1-2.54.7z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-gray-400">
                            <!-- Instagram Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25 22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75 2zm5.25 12.75A3 3 0 1 0 9.75 12a3 3 0 0 0 3 2.75zm6-6.25a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0zM12 9.75a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5zm5.5-4.75a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-gray-400">
                            <!-- YouTube Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M23.498 6.186a2.94 2.94 0 0 0-2.065-2.07C19.426 3.33 12 3.33 12 3.33s-7.426 0-9.433.786a2.94 2.94 0 0 0-2.065 2.07C0 8.195 0 12 0 12s0 3.805.502 5.814a2.94 2.94 0 0 0 2.065 2.07C4.574 20.67 12 20.67 12 20.67s7.426 0 9.433-.786a2.94 2.94 0 0 0 2.065-2.07C24 15.805 24 12 24 12s0-3.805-.502-5.814zM9.75 15.02v-6.04L15.5 12l-5.75 3.02z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-gray-400">
                            <!-- LinkedIn Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M19 3A2 2 0 0 1 21 5v14a2 2 0 0 1-2 2h-5.66V14h2.11l.32-2.34h-2.43V9.8c0-.68.19-1.14 1.18-1.14h1.26V6.69A17.49 17.49 0 0 0 14.6 6c-2.14 0-3.6 1.3-3.6 3.68v2.08H8.88V14h2.12v7H5A2 2 0 0 1 3 19V5a2 2 0 0 1 2-2h14zM7 9.34h2V18H7V9.34zm1-4.32a1.16 1.16 0 1 0 0 2.32 1.16 1.16 0 0 0 0-2.32z" />
                            </svg>
                        </a>
                        <a href="#" class="text-white hover:text-gray-400">
                            <!-- WhatsApp Icon -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20.52 3.48A12.07 12.07 0 0 0 12 0a12.07 12.07 0 0 0-8.52 3.48A12.07 12.07 0 0 0 0 12c0 2.1.55 4.15 1.61 5.97l-1.67 6.05 6.19-1.63A12.05 12.05 0 0 0 12 24a12.07 12.07 0 0 0 8.52-3.48A12.07 12.07 0 0 0 24 12a12.07 12.07 0 0 0-3.48-8.52zm-8.52 19.44A10.17 10.17 0 0 1 4.43 20.2l-.36-.21-3.6.94.97-3.56-.24-.37a10.15 10.15 0 1 1 18.84-5.6 10.19 10.19 0 0 1-10.1 10.52z" />
                            </svg>
                        </a>
                    </div>

                </div>
            </div>
            <div class="py-2 subfooter">
                <p class="text-center text-white">
                    جميع الحقوق محفوظة لـ جمعية التسامح للاعمال الخيرية © {{ date('Y') }} .
                </p>
            </div>
    </footer>
</body>

</html> --}}
