@props(['href' => $href ?? null])

@if (!isset($href))
    <button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex justify-center text-centers items-center px-4 py-2 bg-green-600 dark:bg-green-200 border border-transparent rounded-md font-bold text-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </button>
@else
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'inline-flex justify-center text-centers items-center px-4 py-2 bg-green-600 dark:bg-green-200 border border-transparent rounded-md font-bold text-md text-white dark:text-gray-800 uppercase tracking-widest hover:bg-green-700 dark:hover:bg-white focus:bg-green-700 dark:focus:bg-white active:bg-green-900 dark:active:bg-green-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150']) }}>
        {{ $slot }}
    </a>
@endif
