<div>
    <x-page-header>
        @lang('messages.About')
    </x-page-header>

    <div class="pt-4">
        <div class="container px-4 mx-auto lg:px-0">
            <x-section-header class="text-primary">
                نبذة عن جمعية التسامح
            </x-section-header>
            <div class="grid grid-cols-1 mt-5 lg:grid-cols-2 md:grid-cols-2 gap-x-5">
                <div class="order-2 mt-2 lg:order-1">
                    <div class="leading-6 text-md lg:leading-10 lg:text-lg">
                        {!! $generalSettings->about_text !!}
                    </div>
                </div>
                <div class="order-1 lg:order-2">
                    <img src="{{ asset('images/about.png') }}" alt="" class="mx-auto max-h-[364px]">
                </div>
            </div>
        </div>

        <div class="py-5 mt-4 bg-gray-200 lg:py-8">
            <div class="container block px-4 mx-auto mt-0 lg:mt-4 lg:px-0">
                <x-section-header class="text-primary">
                    أهداف وأغراض الجمعية
                </x-section-header>

                <div class="grid grid-cols-1 gap-3 mt-4 lg:gap-5 lg:grid-cols-3 lg:mt-6">
                    <div class="flex items-start justify-start gap-x-3">
                        <img src="{{ asset('images/about/goals/1.png') }}" alt="" class="lg:size-16 size-12">
                        <div>
                            <h5 class="font-bold text-md lg:text-xl text-primary">الخدمات الإنسانية</h5>
                            <p class="text-sm lg:text-lg">نقدم الخدمات الإنسانية والخيرية والإغاثية والصحية للمنكوبين والمحتاجين خارج الكويت.</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-start gap-x-3">
                        <img src="{{ asset('images/about/goals/2.png') }}" alt="" class="lg:size-16 size-12">
                        <div>
                            <h5 class="font-bold text-md lg:text-xl text-primary">مشاريع البناء</h5>
                            <p class="text-sm lg:text-lg">نبني المساجد والمدارس والمستشفيات والجامعات والمعاهد خارج الكويت.</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-start gap-x-3">
                        <img src="{{ asset('images/about/goals/3.png') }}" alt="" class="lg:size-16 size-12">
                        <div>
                            <h5 class="font-bold text-md lg:text-xl text-primary">الأيتام</h5>
                            <p class="text-sm lg:text-lg">نقوم بإنشاء دور الأيتام وكفالة الأيتام خارج الكويت.</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-start gap-x-3">
                        <img src="{{ asset('images/about/goals/4.png') }}" alt="" class="lg:size-16 size-12">
                        <div>
                            <h5 class="font-bold text-md lg:text-xl text-primary">إفطار الصائم</h5>
                            <p class="text-sm lg:text-lg">نقوم بتوفير إفطار الصائم والأضاحي ومساعدة الأسر الفقيرة ورفع المعاناة.</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-start gap-x-3">
                        <img src="{{ asset('images/about/goals/5.png') }}" alt="" class="lg:size-16 size-12">
                        <div>
                            <h5 class="font-bold text-md lg:text-xl text-primary">استقبال الإعانات</h5>
                            <p class="text-sm lg:text-lg">نتلقى الإعانات والوصايا والهبات والزكوات والصدقات وتوزيعها على مستحقيها.</p>
                        </div>
                    </div>

                    <div class="flex items-start justify-start gap-x-3">
                        <img src="{{ asset('images/about/goals/6.png') }}" alt="" class="lg:size-16 size-12">
                        <div>
                            <h5 class="font-bold text-md lg:text-xl text-primary">مشاريع خاصة</h5>
                            <p class="text-sm lg:text-lg">نقوم بتلقي تبرعات المحسنين لإنشاء مساجد ومشاريع خيرية حسب رغبتهم.</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="py-4 bg-about-page-section-1">
            <div class="container block px-4 mx-auto lg:px-0">
                <x-section-header class="text-white">
                    ماذا نستقبل
                </x-section-header>
                <div class="grid items-center justify-center grid-cols-2 mt-6 text-center lg:grid-cols-5 lg:gap-8 gap-y-4 gap-x-8">
                    <div>
                        <div class="inline-block bg-white rounded-full w-54 h-54">
                            <div class="flex items-center p-5 mx-auto bg-white rounded-full lg:size-24 size-20">
                                <img src="{{ asset('images/about/receive/1.png') }}" alt="" class="lg:size-18 size-18">
                            </div>
                        </div>
                        <h5 class="my-4 font-bold text-white lg:text-xl text-md">مشاريع منوعة</h5>
                    </div>
                    {{--  --}}
                    <div>
                        <div class="inline-block bg-white rounded-full w-54 h-54">
                            <div class="flex items-center p-5 mx-auto bg-white rounded-full lg:size-24 size-20">
                                <img src="{{ asset('images/about/receive/2.png') }}" alt="" class="lg:size-18 size-18">
                            </div>

                        </div>
                        <h5 class="my-4 font-bold text-white lg:text-xl text-md">زكاة وكفارات</h5>
                    </div>

                    <div>
                        <div class="inline-block bg-white rounded-full w-54 h-54">
                            <div class="flex items-center p-5 mx-auto bg-white rounded-full lg:size-24 size-20">
                                <img src="{{ asset('images/about/receive/3.png') }}" alt="" class="lg:size-18 size-18">
                            </div>
                        </div>
                        <h5 class="my-4 font-bold text-white lg:text-xl text-md">كفالة أيتام</h5>
                    </div>

                    <div>
                        <div class="inline-block bg-white rounded-full w-54 h-54">
                            <div class="flex items-center p-5 mx-auto bg-white rounded-full lg:size-24 size-20">
                                <img src="{{ asset('images/about/receive/4.png') }}" alt="" class="lg:size-18 size-18">
                            </div>
                        </div>
                        <h5 class="my-4 font-bold text-white lg:text-xl text-md text-nowrap">إفطار صائم والأضاحي</h5>
                    </div>

                    <div class="col-span-full lg:col-span-1">
                        <div class="inline-block bg-white rounded-full w-54 h-54">
                            <div class="flex items-center p-5 mx-auto bg-white rounded-full lg:size-24 size-20">
                                <img src="{{ asset('images/about/receive/5.png') }}" alt="" class="lg:size-18 size-18">
                            </div>
                        </div>
                        <h5 class="my-4 font-bold text-white lg:text-xl text-md">صدقات</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-5">
            <div class="container block px-4 mx-auto lg:px-0">
                <x-section-header class="text-primary">
                    أعضاء مجلس الإدارة
                </x-section-header>

                <div class="grid grid-cols-2 gap-3 my-5 lg:grid-cols-4">
                    @foreach ($boardMembers as $boardMember)
                        <div class="px-2 py-3 text-center bg-[#0072BB] rounded-lg">
                            <h4 class="text-sm font-bold text-white lg:text-xl">{{ $boardMember->name }}</h4>
                            <p class="text-sm text-gray-100 lg:text-lg">{{ $boardMember->role }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
