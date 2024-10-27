<div>
    <!-- Slider Section -->
    <div class="w-full max-w-full mx-auto" wire:ignore>
        <!-- Slider main container -->
        <div class="relative swiper-container">
            <div class="swiper-wrapper">
                <!-- Slides -->
                @foreach ($slides as $slide)
                    <div class="relative flex items-center justify-center text-center text-white bg-blue-500 h-96 swiper-slide">
                        <img src="{{ $slide['image'] }}" alt="" class="object-cover w-full h-96">
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

    <section class="py-4">
        <div class="container">

        </div>
    </section>

    {{-- <div x-data="{
        currentSlide: 0,
        sliders: {{ json_encode($sliders) }},
        next() {
            this.currentSlide = (this.currentSlide + 1) % this.sliders.length;
        },
        prev() {
            this.currentSlide = (this.currentSlide - 1 + this.sliders.length) % this.sliders.length;
        },
        init() {
            setInterval(() => { this.next() }, 5000);
        }
    }" x-init="init()">

        <template x-for="(slide, index) in sliders" :key="index">
            <div x-show="currentSlide === index" class="slide">
                <img :src="slide.image" alt="Slide Image" class="object-cover w-full bg-gray-100 h-100">
                <div class="overlay">
                    <h2 x-text="slide.title"></h2>
                    <p x-text="slide.paragraph"></p>
                </div>
            </div>
        </template>

        <button @click="prev()" class="prev-button">Previous</button>
        <button @click="next()" class="next-button">Next</button>
    </div> --}}


</div>
