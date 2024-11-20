@use('App\Settings\GeneralSettings', 'GeneralSettings')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    @production
        <!-- Google Tag Manager -->
        <script>
            (function(w, d, s, l, i) {
                w[l] = w[l] || [];
                w[l].push({
                    'gtm.start': new Date().getTime(),
                    event: 'gtm.js'
                });
                var f = d.getElementsByTagName(s)[0],
                    j = d.createElement(s),
                    dl = l != 'dataLayer' ? '&l=' + l : '';
                j.async = true;
                j.src =
                    'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
                f.parentNode.insertBefore(j, f);
            })
            (window, document, 'script', 'dataLayer', 'GTM-WT8HQRNS');
        </script>
        <!-- End Google Tag Manager -->
    @endproduction
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Favicon --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon.png') }}">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('images/favicon.png') }}" type="image/x-icon">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased rtl">
    @production
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WT8HQRNS" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
    @endproduction
    {{-- <div class="py-3 font-bold text-center text-white bg-orange-500 w-100">
        @lang('messages.You have not verified your phone number yet. Please verify your phone number.')
    </div> --}}
    <div class="min-h-screen bg-gray-100">
        @include('layouts.navigation')

        @if (Request::is('profile*'))
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
                                <a href="{{ route('profile.donations') }}" class="flex items-center justify-between px-4 py-3 text-sm font-medium text-gray-800 bg-white border-b border-gray-300 gap-x-2 focus:outline-none disabled:opacity-50 disabled:pointer-events-none hover:bg-gray-50">
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
        @else
            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        @endif

        <footer class="relative z-10 text-white" style="background: linear-gradient(270deg, #0071BC 43.5%, #1751A5 100%);">
            <div class="absolute hidden -translate-x-1/3 left-1/2 lg:block -z-10">
                <svg width="580" height="210" viewBox="0 0 580 201" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path opacity="0.2" d="M587 -70.1253V0.348083C542.895 19.8664 496.599 33.5252 449.186 44.7754C284.126 83.9517 143.604 160.773 53.1184 311.035C32.3531 345.519 16.4523 382.272 7.48156 421.757C7.04749 423.692 6.07958 425.507 4.56783 428.754C4.12378 429.701 3.63483 430.768 3.10098 432C2.95629 430.918 2.8166 429.836 2.68188 428.754C-7.74069 345.419 12.7402 272.004 54.9894 204.687C73.0405 175.928 98.1615 151.692 118.807 124.449C171.369 55.0881 216.796 -18.2926 242.376 -102.4C243.01 -104.469 244.247 -106.359 247.191 -108C254.096 -40.2544 234.254 24.5739 224.096 92.883C259.694 65.9344 298.221 48.715 336.354 30.6828C393.721 3.56457 454.64 -14.2084 513.553 -37.2075C538.784 -47.0614 563.306 -57.9825 587 -70.1253Z" fill="white" />
                </svg>

            </div>
            <div class="">
                <div class="container flex flex-col flex-wrap justify-between grid-cols-1 px-4 py-6 mx-auto lg:gap-5 lg:grid-cols-3 grow-0 lg:flex-row">
                    <div class="grow-0 lg:max-w-72">
                        <div class="text-center">
                            <a class="inline-block mx-auto" href="{{ route('home') }}"><img src="{{ asset('images/logo-white.png') }}?v=1" alt="Al Tasamoh Logo" class="w-auto h-8 mb-3"></a>
                        </div>
                        <div>
                            <p class="text-sm text-center lg:text-md lg:text-start">جمعية التسامح للأعمال الخيرية لتنمية المجتمع والمساهمة في إنماء المجتمع ومساعدة المحتاجين ومشاريع الأوقاف</p>
                        </div>
                    </div>

                    <nav class="flex-col hidden gap-2 pt-2 mt-6 text-center border-t lg:flex lg:border-t-0 lg:mt-0 lg:text-start border-t-blue-500">
                        <h5 class="font-bold">روابط هامة</h5>
                        <a href="{{ route('privacy-policy') }}" class="hover:underline">سياسة الخصوصية</a>
                        <a href="{{ route('about') }}" class="hover:underline">من نحن</a>
                        <a href="{{ route('galleries.list') }}" class="hover:underline">المركز الإعلامي</a>
                        <a href="{{ route('contact') }}" class="hover:underline">تواصل معنا</a>
                    </nav>

                    <div class="flex flex-col gap-2 pt-2 mt-2 text-center lg:items-center md:items-start lg:text-start ">
                        <h3 class="hidden mb-4 text-lg font-semibold lg:block">تواصل معنا</h3>
                        <div class="flex justify-center w-full space-x-3 space-x-reverse">
                            @if (app(GeneralSettings::class)->whatsapp_number)
                                <a href="https://api.whatsapp.com/send?phone={{ app(GeneralSettings::class)->whatsapp_number }}" target="_blank" class="text-white hover:text-gray-400">
                                    <!-- WhatsApp Icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_530_1048)">
                                            <path d="M12.0054 0C5.37506 0 0 5.32507 0 11.8937C0 14.1151 0.611533 16.1878 1.6844 17.9628L0.171658 24.0106L6.19043 22.2994C7.91775 23.2453 9.89182 23.7874 12.0054 23.7874C18.6357 23.7874 24.0107 18.4624 24.0107 11.8937C24 5.32507 18.6357 0 12.0054 0ZM12.1341 21.8105C10.042 21.8105 8.08941 21.1621 6.49084 20.0673L3.06839 21.0452L3.94814 17.5483C2.83236 15.9539 2.17792 14.0195 2.17792 11.9362C2.17792 6.48361 6.64104 2.062 12.1448 2.062C17.6486 2.062 22.1118 6.48361 22.1118 11.9362C22.101 17.3888 17.6379 21.8105 12.1341 21.8105Z" fill="white" />
                                            <path d="M8.96918 10.9476C9.10865 10.7881 9.24812 10.6287 9.3876 10.4693C9.62363 10.2036 9.96695 9.93783 9.9884 9.55519C9.99913 9.18318 9.87039 8.8218 9.74164 8.48167C9.65581 8.25847 9.56998 8.04589 9.48416 7.83331C9.33395 7.42942 9.13011 6.87671 8.91554 6.64288C8.61513 6.33464 8.10016 6.27087 7.7032 6.46219C7.7032 6.46219 5.34289 7.57822 6.07244 9.83154C6.07244 9.83154 7.4779 16.1557 14.5374 17.4631C14.5374 17.4631 17.0693 17.8245 17.7559 16.2939C17.9061 15.9644 18.0027 15.4967 17.9812 15.146C17.9598 14.7952 17.713 14.572 17.4234 14.402C17.0479 14.1894 16.7153 13.9981 16.2969 13.7855C15.9321 13.6048 15.5029 13.3391 15.0845 13.456C14.7734 13.541 14.5481 13.8174 14.3442 14.0406C14.0653 14.3276 13.7863 14.6145 13.5074 14.9015C13.4967 14.8909 9.9133 13.5942 8.96918 10.9476Z" fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_530_1048">
                                                <rect width="24" height="24" fill="white" />
                                            </clipPath>
                                        </defs>
                                    </svg>
                                </a>
                            @endif
                            @if (app(GeneralSettings::class)->facebook_url)
                                <a href="{{ app(GeneralSettings::class)->facebook_url }}" target="_blank" class="text-white hover:text-gray-400">
                                    <svg fill="#fff" width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M12 2.03998C6.5 2.03998 2 6.52998 2 12.06C2 17.06 5.66 21.21 10.44 21.96V14.96H7.9V12.06H10.44V9.84998C10.44 7.33998 11.93 5.95998 14.22 5.95998C15.31 5.95998 16.45 6.14998 16.45 6.14998V8.61998H15.19C13.95 8.61998 13.56 9.38998 13.56 10.18V12.06H16.34L15.89 14.96H13.56V21.96C15.9164 21.5878 18.0622 20.3855 19.6099 18.57C21.1576 16.7546 22.0054 14.4456 22 12.06C22 6.52998 17.5 2.03998 12 2.03998Z" />
                                    </svg>
                                </a>
                            @endif
                            @if (app(GeneralSettings::class)->youtube_url)
                                <a href="{{ app(GeneralSettings::class)->youtube_url }}" target="_blank" class="text-white hover:text-gray-400">
                                    <!-- YouTube Icon -->
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_530_1044)">
                                            <path d="M20.595 3.18413C16.991 2.93813 8.96398 2.93913 5.36498 3.18413C1.46798 3.45013 1.00898 5.80412 0.97998 12.0001C1.00898 18.1851 1.46398 20.5491 5.36498 20.8161C8.96498 21.0611 16.991 21.0621 20.595 20.8161C24.492 20.5501 24.951 18.1961 24.98 12.0001C24.951 5.81512 24.496 3.45113 20.595 3.18413ZM9.97998 16.0001V8.00013L17.98 11.9931L9.97998 16.0001Z" fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_530_1044">
                                                <rect width="24" height="24" fill="white" transform="translate(0.97998)" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </a>
                            @endif

                            @if (app(GeneralSettings::class)->instagram_url)
                                <a href="{{ app(GeneralSettings::class)->instagram_url }}" target="_blank" class="text-white hover:text-gray-400">
                                    <!-- Instagram Icon -->
                                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <g clip-path="url(#clip0_530_1042)">
                                            <path d="M12.98 2.163C16.184 2.163 16.564 2.175 17.83 2.233C21.082 2.381 22.601 3.924 22.749 7.152C22.807 8.417 22.818 8.797 22.818 12.001C22.818 15.206 22.806 15.585 22.749 16.85C22.6 20.075 21.085 21.621 17.83 21.769C16.564 21.827 16.186 21.839 12.98 21.839C9.77598 21.839 9.39598 21.827 8.13098 21.769C4.87098 21.62 3.35998 20.07 3.21198 16.849C3.15398 15.584 3.14198 15.205 3.14198 12C3.14198 8.796 3.15498 8.417 3.21198 7.151C3.36098 3.924 4.87598 2.38 8.13098 2.232C9.39698 2.175 9.77598 2.163 12.98 2.163ZM12.98 0C9.72098 0 9.31298 0.014 8.03298 0.072C3.67498 0.272 1.25298 2.69 1.05298 7.052C0.99398 8.333 0.97998 8.741 0.97998 12C0.97998 15.259 0.99398 15.668 1.05198 16.948C1.25198 21.306 3.66998 23.728 8.03198 23.928C9.31298 23.986 9.72098 24 12.98 24C16.239 24 16.648 23.986 17.928 23.928C22.282 23.728 24.71 21.31 24.907 16.948C24.966 15.668 24.98 15.259 24.98 12C24.98 8.741 24.966 8.333 24.908 7.053C24.712 2.699 22.291 0.273 17.929 0.073C16.648 0.014 16.239 0 12.98 0ZM12.98 5.838C9.57698 5.838 6.81798 8.597 6.81798 12C6.81798 15.403 9.57698 18.163 12.98 18.163C16.383 18.163 19.142 15.404 19.142 12C19.142 8.597 16.383 5.838 12.98 5.838ZM12.98 16C10.771 16 8.97998 14.21 8.97998 12C8.97998 9.791 10.771 8 12.98 8C15.189 8 16.98 9.791 16.98 12C16.98 14.21 15.189 16 12.98 16ZM19.386 4.155C18.59 4.155 17.945 4.8 17.945 5.595C17.945 6.39 18.59 7.035 19.386 7.035C20.181 7.035 20.825 6.39 20.825 5.595C20.825 4.8 20.181 4.155 19.386 4.155Z" fill="white" />
                                        </g>
                                        <defs>
                                            <clipPath id="clip0_530_1042">
                                                <rect width="24" height="24" fill="white" transform="translate(0.97998)" />
                                            </clipPath>
                                        </defs>
                                    </svg>

                                </a>
                            @endif
                            @if (app(GeneralSettings::class)->x_url)
                                <a href="{{ app(GeneralSettings::class)->x_url }}" target="_blank" class="text-white hover:text-gray-400">
                                    <!-- X Icon -->
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M14.2737 10.1635L23.2023 0H21.0872L13.3313 8.82305L7.14125 0H0L9.3626 13.3433L0 24H2.11504L10.3002 14.6806L16.8388 24H23.98M2.8784 1.5619H6.12769L21.0856 22.5148H17.8355" fill="white" />
                                    </svg>
                                </a>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="p-2 subfooter">
                    <p class="text-sm text-center text-white lg:text-md">
                        جميع الحقوق محفوظة لـ جمعية التسامح للاعمال الخيرية © {{ date('Y') }} . تمت البرمجة بواسطة <strong><a href="https://badayh-agency.com/">شركة بداية</a></strong>
                    </p>
                </div>
        </footer>

        <script>
            function updateGregorianClockInArabicKuwait() {
                const now = new Date();
                const gregorianDateFormatter = new Intl.DateTimeFormat("ar-KW", {
                    day: "numeric",
                    month: "long",
                    year: "numeric",
                    hour: "numeric",
                    minute: "numeric",
                    hour12: true
                });
                let gregorianDateTime = gregorianDateFormatter.format(now);
                gregorianDateTime = gregorianDateTime.replace("في", "  ");
                document.getElementById("gregorian-clock").innerText = gregorianDateTime;
            }

            setInterval(updateGregorianClockInArabicKuwait, 1000);
        </script>
        <script>
            window.whatsappWidgetSetting = {
                header: "جمعية التسامح للاعمال الخيرية",
                subHeader: "",
                color: "#000",
                whatsappButtonText: "ارسال",
                widgetPosition: "bottom-right",
                widgetBubbleType: "standard",
                message: "السلام عليكم",
                whatsappNumber: "+96550727495"
            };

            // Dynamically load the WhatsApp SDK from the server
        </script>
        <script src='https://social.social-bot.io/packs/js/whatsappsdk.js' defer></script>
</body>

</html>
