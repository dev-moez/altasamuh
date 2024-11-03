<div>
    <!-- Slider Section -->
    <div class="w-full max-w-full mx-auto overflow-hidden" wire:ignore>
        <!-- Slider main container -->
        <div class="relative swiper-container">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($slides as $slide)
                    <div class="relative flex items-center justify-center text-center text-white bg-blue-500 h-[500px] swiper-slide">
                        <img src="{{ $slide['image'] }}" alt="" class="object-cover w-full h-[500px]">
                        <div class="absolute transform -translate-x-1/2 -translate-y-2/3 top-2/3 left-1/2">
                            <h2 class="text-3xl font-bold">{{ $slide['heading'] }}</h2>
                            <p class="text-lg">{{ $slide['sub_heading'] }}</p>
                        </div>

                    </div>
                @endforeach
            </div>
            <!-- Pagination (Bullets) -->
            <div class="swiper-pagination"></div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        </div>
    </div>

    <section class="pt-8 pb-12">
        <div class="container">
            <div class="flex flex-grow-0 w-full">
                <div class="flex-1 p-6 border-[5px] lg:border-l-0 border-[#0072BB] rounded-lg rounded-l-lg lg:rounded-l-none">
                    <h4 class="lg:text-4xl text-3xl font-bold text-[#2E3192] mb-3">
                        الزكاة والصدقات والكفارات
                    </h4>
                    <p class="mt-2 text-gray-600">الغرض من التبرع</p>
                    <div class="flex gap-3 mt-4">
                        @forelse($miscDonations as $donation)
                            <button class="px-5 py-2 text-sm text-gray-800 bg-gray-200 rounded-md">{{ $donation->name }}</button>
                        @empty
                        @endforelse
                    </div>
                </div>
                <div class="relative flex-1 hidden lg:block">
                    <img src="{{ asset('images/mask-bg.png') }}" class="">
                    <img src="{{ asset('images/misc-donations.png') }}" class="absolute top-0 opacity-35">

                </div>
            </div>
        </div>
    </section>
    <section class="pt-8 pb-12">
        <div class="container">
            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                @forelse($projects as $project)
                    <livewire:projects.project-card :project="$project" />
                @empty
                @endforelse
            </div>
        </div>
    </section>
    <section class="pt-8 pb-12">
        <div class="container">
            <x-section-header class="text-blue-900">
                أخبــار الجمــعيــة
            </x-section-header>

            <div class="grid grid-cols-1 gap-4 lg:grid-cols-3">
                @forelse ($articles as $article)
                    <x-pages.article-card :article="$article" />
                @empty
                @endforelse
            </div>
            <div class="mt-6 text-center">
                <a href="{{ route('articles.list') }}" class="px-4 py-2 text-white rounded-lg text-md hover:bg-blue-600 bg-primary">
                    المزيد من الأخبار
                </a>
            </div>
        </div>
    </section>
</div>
