@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-medium text-sm text-[#07A54F] dark:text-green-400']) }}>
        {{ $status }}
    </div>
@endif
