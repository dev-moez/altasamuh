<div>
    <div class="text-center max-w-[70%] mx-auto">
        <h2 {{ $attributes->merge(['class' => "inline-flex relative text-center text-lg lg:text-2xl font-bold lg:before:content-[''] after:content-[''] lg:before:absolute lg:after:absolute lg:before:top-1/2 lg:after:top-1/2 lg:before:w-[45px] lg:after:w-[45px] lg:before:h-[2px] lg:after:h-[2px] lg:before:bg-[#1F9E46] lg:after:bg-[#1F9E46] lg:before:-left-[60px] lg:after:-right-[60px]"]) }}>
            {{ $slot ?? '' }}
        </h2>
    </div>
</div>
