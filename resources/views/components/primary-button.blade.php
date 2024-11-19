@props(['href' => $href ?? null])

@if (!isset($href))
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center text-centers items-center px-3 py-2 bg-[#07A54F] border border-transparent rounded-md font-bold text-md text-white uppercase tracking-widest hover:bg-green-700  focus:bg-green-700  active:bg-green-900  focus:outline-none  transition ease-in-out duration-150 disabled:opacity-25 disabled:cursor-not-allowed']) }}>
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex justify-center text-centers items-center px-3 py-2 bg-[#07A54F] border border-transparent rounded-md font-bold text-md text-white uppercase tracking-widest hover:bg-green-700  focus:bg-green-700  active:bg-green-900  focus:outline-none  transition ease-in-out duration-150 disabled:opacity-25 disabled:cursor-not-allowed']) }}>
        {{ $slot }}
    </a>
@endif
