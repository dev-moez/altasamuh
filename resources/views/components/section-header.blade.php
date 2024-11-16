<div>
    <div class="text-center max-w-[80%]">
        <h2 {{ $attributes->merge(['class' => "inline-flex relative text-center text-2xl font-bold my-8 before:content-[''] after:content-[''] before:absolute after:absolute before:top-1/2 after:top-1/2 before:w-[45px] after:w-[45px] before:h-[2px] after:h-[2px] before:bg-[#1F9E46] after:bg-[#1F9E46] before:-left-[60px] after:-right-[60px]"]) }}>
            {{ $slot ?? '' }}
        </h2>
    </div>
</div>
