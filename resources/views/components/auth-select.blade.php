@props([
    'disabled' => false,
    'placeholer' => $placeholder ?? '',
])

<select {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-0  focus:outline-0 focus:ring-0 text-right px-0']) !!}>
    {{ $slot }}
</select>
