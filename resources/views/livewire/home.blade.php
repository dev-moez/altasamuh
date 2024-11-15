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

    <section class="bg-white py-14">
        <div class="container">
            <div class="flex flex-grow-0 w-full">
                <div class="flex-1 p-6 border-[5px] lg:border-l-0 border-[#0072BB] rounded-lg rounded-l-lg lg:rounded-l-none">
                    <h4 class="lg:text-4xl text-3xl font-bold text-[#2E3192] mb-3">
                        الزكاة والصدقات والكفارات
                    </h4>
                    <p class="mt-4 font-bold text-[#979797]">الغرض من التبرع</p>
                    <livewire:misc-donation-actions wire:key='{{ uniqid() }}' />
                </div>
                <div class="relative flex-1 hidden overflow-hidden lg:block">
                    {{-- <img src="{{ asset('images/mask-bg.png') }}" class=""> --}}
                    <img src="{{ asset('images/misc-donations.png') }}?v=1" class="absolute top-0 bottom-0">

                </div>
            </div>
        </div>
    </section>
    <section class="pt-20 pb-12">
        <div class="container">
            <div class="p-4 border-[#0072BB] border-2 rounded-xl">
                {{-- <div class="px-6 pb-5 mt-8 border border-blue-600 rounded-xl"> --}}
                {{-- Tabs --}}
                <div class="relative flex items-center justify-center px-2 py-2 mx-auto bg-white rounded-3xl gap-x-1 w-fit -top-10">
                    @forelse($categories as $category)
                        <button wire:click.prevent="$set('currentCategoryId', {{ $category->id }} )" type="button" class="px-6 py-2 rounded-2xl {{ $currentCategoryId == $category->id ? 'bg-[#0072BB] text-white font-bold' : 'bg-transparent text-gray-700' }}">
                            {{ $category->name }}
                        </button>
                    @empty
                    @endforelse
                </div>
                {{-- </div> --}}
                <div class="grid grid-cols-1 gap-4 lg:gap-0 lg:gap-x-2 lg:grid-cols-3">
                    @forelse($projects as $project)
                        <div class="border-2 border-gray-200 rounded-lg ">
                            <img src="{{ $project->getFirstMedia('project-cover')?->getUrl() }}" alt="" class="object-cover object-center w-full rounded-t-lg h-72">
                            <div class="px-3 pt-4 pb-6 bg-white">
                                <div class="mb-4">
                                    <a href="{{ route('projects.view', $project) }}">
                                        <h2 class="font-bold text-md">{{ $project->title }}</h2>
                                    </a>
                                </div>
                                <livewire:projects.project-donation-actions :project="$project" wire:key='{{ uniqid() }}' />
                            </div>
                        </div>
                    @empty
                    @endforelse
                </div>
            </div>
        </div>
    </section>
    @if ($articles->count() > 0)
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
                <div class="mt-10 text-center">
                    <a href="{{ route('articles.list') }}" class="px-8 py-2 font-bold text-white rounded-2xl text-md hover:bg-blue-600 bg-primary">
                        المزيد من الأخبار
                    </a>
                </div>
            </div>
        </section>
    @endif
</div>
