<div>
    <!-- Slider Section -->
    <div class="w-full max-w-full mx-auto overflow-hidden" wire:ignore>
        <!-- Slider main container -->
        <div class="relative swiper-container">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($slides as $slide)
                    <div class="relative flex items-center justify-center text-center text-white bg-blue-500 lg:h-[500px] h-[175px] swiper-slide">
                        <a href="{{ $slide['link'] }}" class="block w-full h-full p-0">
                            <img src="{{ $slide['image'] }}" alt="" class="object-cover object-center w-full lg:h-[500px] h-[175px]">
                        </a>
                        {{-- <div class="absolute transform -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2 max-w-[80%] w-[80%]">
                            <h2 class="mb-4 text-xl font-bold lg:text-3xl">{{ $slide['heading'] }}</h2>
                            <p class="lg:text-lg text-md">{{ $slide['sub_heading'] }}</p>
                        </div> --}}
                    </div>
                @endforeach
            </div>
            <!-- Pagination (Bullets) -->
            <div class="!bottom-6 swiper-pagination !text-yellow-400"></div>

            <!-- Navigation buttons -->
            <div class="swiper-button-next !text-white"></div>
            <div class="swiper-button-prev !text-white"></div>
        </div>
    </div>

    <section class="py-3 bg-white">
        <div class="container">
            <div class="flex flex-grow-0 w-full">
                <div class="flex-1 p-3 pb-0 border-[5px] lg:border-l-0 border-[#0072BB] rounded-lg rounded-l-lg lg:rounded-l-none">
                    <h4 class="lg:text-5xl text-lg font-bold text-[#2E3192] mb-3">
                        الزكاة والصدقات والكفارات
                    </h4>
                    <p class="font-bold text-[#979797]">الغرض من التبرع</p>
                    <livewire:misc-donation-actions wire:key='{{ uniqid() }}' />
                </div>
                <div class="relative flex-1 hidden overflow-hidden lg:block">
                    <img src="{{ asset('images/misc-donations.png') }}?v=1" class="absolute top-0 left-0 object-cover object-left w-full h-full rounded-l-t-[40%]">
                </div>
            </div>
        </div>
    </section>
    <section class="pt-12">
        <div class="container">
            <div class="p-2 border-[#0072BB] border-2 rounded-xl">
                <div class="relative flex flex-wrap items-center justify-center px-2 py-2 mx-auto bg-white rounded-3xl gap-x-1 -top-10 w-fit">
                    @forelse($categories as $category)
                        <button wire:click.prevent="$set('currentCategoryId', {{ $category->id }} )" type="button" class="px-2 py-2 rounded-2xl {{ $currentCategoryId == $category->id ? 'bg-[#0072BB] text-white font-bold' : 'bg-transparent text-gray-700' }}">
                            {{ $category->name }}
                        </button>
                    @empty
                    @endforelse
                </div>
                {{-- </div> --}}
                <div class="relative grid grid-cols-1 gap-4 -mt-8 lg:gap-0 lg:gap-x-2 lg:grid-cols-3">
                    @forelse($projects as $project)
                        <div class="relative border-2 border-gray-200 rounded-lg">
                            <a href="{{ route('projects.view', $project) }}">
                                <img src="{{ $project->getFirstMedia('project-cover')?->getUrl() }}" alt="" class="object-cover object-top w-full rounded-t-lg h-[200px]">
                            </a>
                            <div class="px-3 pt-4 pb-6 bg-white rounded-b-lg">
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
        <section class="pt-5 pb-8 bg-top bg-no-repeat bg-cover" style="background-image: url('{{ asset('images/articles-bg.png') }}')">
            <div class="container">
                <x-section-header class="text-blue-900">
                    أخبــار الجمــعيــة
                </x-section-header>

                <div class="grid grid-cols-1 gap-4 mt-5 lg:grid-cols-3">
                    @forelse ($articles as $article)
                        <x-pages.article-card :article="$article" />
                    @empty
                    @endforelse
                </div>
                <div class="mt-10 text-center">
                    <a href="{{ route('articles.list') }}" class="px-6 py-2 text-sm font-bold text-white rounded-2xl lg:text-md hover:bg-blue-600 bg-primary">
                        المزيد من الأخبار
                    </a>
                </div>
            </div>
        </section>
    @endif
</div>
