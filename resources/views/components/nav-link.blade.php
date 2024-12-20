@props(['active'])

@php
    $classes = $active ?? false ? 'inline-flex items-center px-1 pb-2 pt-1  text-md font-bold leading-5 text-blue-600 focus:outline-none  transition duration-150 ease-in-out' : 'inline-flex items-center px-1 pb-2 pt-1  text-md font-bold leading-5 text-gray-500 hover:text-gray-700  focus:outline-none focus:text-gray-700  transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
