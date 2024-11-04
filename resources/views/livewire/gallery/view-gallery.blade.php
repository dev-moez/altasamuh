<div>
    <x-page-header>
        {{ $gallery->title }}
    </x-page-header>
    <div class="container py-10">
        <div class="w-full max-w-full mx-auto overflow-hidden" wire:ignore>
            @if (count($slides) > 0)
                <!-- Slider main container -->
                <div class="relative swiper-container">
                    <div class="swiper-wrapper">
                        <!-- Slides -->
                        @foreach ($slides as $slide)
                            <div class="relative flex items-center justify-center text-center text-white bg-blue-500 h-[500px] swiper-slide">
                                <img src="{{ $slide['image'] }}" alt="" class="object-cover w-full h-[500px]">
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
