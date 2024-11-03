<div>
    <x-page-header>
        @lang('messages.About')
    </x-page-header>

    <div class="py-8">
        <div class="container px-4 mx-auto lg:px-0">
            <div class="grid grid-cols-1 lg:grid-cols-2 md:grid-cols-2 gap-x-5">
                <div>
                    <p class="text-lg leading-10">بدأت الجمعيــة أعمالها في أوجه الخير والمشاريع ذات النفع العام على شكل لجنة تحت اسم " لجنـة الفـلاح الخيرية " بتاريخ 1/3/1981م كلجنه  تطوعية غير حكومية مهتمة بالتنمية في الأماكن الأكثر احتياجاً في الهند وبنغلاديس واستمرت اللجنـة في تقديم خدماتها وفقا لأهداف تكوينها حتى أصدرت وزارة الشئون الاجتماعية والعمل القرار الوزاري رقم 212 لسـنة 2000 لإشـهار " مبـرة الفــلاح الخيرية " بتاريخ 26/11/2000م وسجلت لدى الوزارة تحت رقم 100 ورخص لها بإقامة المشـاريع الخيريــة . بعد (37) عاما من العطاء و مساعده الاخرين تم إشهار جمعيــة التسامح للأعمال الخيرية وذلك وفي 20 / 2 / 2018م</p>
                </div>
                <div>
                    <img src="{{ asset('images/about.png') }}" alt="" class="mx-auto max-h-[364px]">
                </div>
            </div>
        </div>

        <div class="py-10 mt-10 bg-gray-200">
            <div class="container block px-4 py-6 mx-auto lg:px-0">
                <x-section-header class="text-primary">
                    أهداف وأغراض الجمعية
                </x-section-header>

                <div class="grid grid-cols-1 lg:grid-cols-3">
                    @for ($x = 1; $x <= 6; $x++)
                        <div class="flex items-start justify-start py-4 gap-x-3">
                            <div class="items-start p-2 bg-blue-500 rounded h-fit w-fit">
                                <img src="{{ asset('images/about/goals/1.svg') }}" alt="" class="w-24 mx-auto">
                            </div>
                            <div>
                                <h5 class="text-xl font-bold text-primary">الخدمات الإنسانية</h5>
                                <p>نقدم الخدمات الإنسانية والخيرية والإغاثية والصحية للمنكوبين والمحتاجين خارج الكويت.</p>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="py-10 bg-about-page-section-1">
            <div class="container block px-4 py-6 mx-auto lg:px-0">
                <x-section-header class="text-white">
                    ماذا نستقبل
                </x-section-header>

                <div class="grid grid-cols-1 lg:grid-cols-5">
                    @for ($x = 1; $x <= 5; $x++)
                        <div class="text-center">
                            <div class="inline-block bg-white rounded-full w-54 h-54">
                                <img src="{{ asset('images/about/1.svg') }}" alt="" class="p-5 mx-auto size-24">
                            </div>
                            <h5 class="my-4 text-xl font-bold text-white">مشاريع منوعة</h5>
                        </div>
                    @endfor
                </div>
            </div>
        </div>

        <div class="py-10">
            <div class="container block px-4 py-6 mx-auto lg:px-0">
                <x-section-header class="text-primary">
                    أعضاء مجلس الإدارة
                </x-section-header>

                <div class="grid grid-cols-2 gap-6 my-4 lg:grid-cols-4">
                    @for ($x = 1; $x <= 8; $x++)
                        <div class="p-5 text-center bg-[#0072BB] rounded-lg">
                            <h4 class="text-xl font-bold text-white">محمد أحمد الفرحان</h4>
                            <p class="text-gray-100">نائب رئيس مجلس الإدارة</p>
                        </div>
                    @endfor
                </div>
            </div>
        </div>
    </div>
</div>
