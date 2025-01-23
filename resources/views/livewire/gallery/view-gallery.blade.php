<div>
    <x-page-header>
        {{ $gallery->title }}
    </x-page-header>
    <div class="container py-10">
        <div class="w-full max-w-full mx-auto overflow-hidden" wire:ignore>
            @if (count($slides) > 0)
                <!-- Slider main container -->
                <div class="relative gallery-swiper">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($slides as $slide)
                            <div class="relative flex items-center justify-center text-center text-white bg-blue-500 lg:h-[525px] h-[350px] swiper-slide">
                                @if ($slide['type'] == 'video')
                                    <iframe class="youtube-iframe" width="100%" height="100%" src="https://www.youtube.com/embed/{{ $slide['url'] }}?enablejsapi=1" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                @else
                                    <img src="{{ $slide['url'] }}" alt="" class="w-full h-full object-fit">
                                @endif
                                <div class="absolute transform -translate-x-1/2 -translate-y-2/3 top-2/3 left-1/2">
                                    <h2 class="text-3xl font-bold">{{ $slide['heading'] }}</h2>
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
            @else
                <x-no-data />
            @endif
        </div>
    </div>
</div>
