@props([
    'disabled' => false,
    'placeholer' => $placeholder ?? '',
])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0  focus:outline-0 focus:ring-0 text-right px-0']) !!}>
