@props(['type' => 'info'])

@php
    $classes = [
        'info' => 'bg-blue-500 text-white',
        'success' => 'bg-green-500 text-white',
        'warning' => 'bg-yellow-500 text-black',
        'error' => 'bg-red-500 text-white',
    ];

    $class = $classes[$type] ?? $classes['info'];
@endphp

<div {{ $attributes->merge(['class' => "p-4 mb-4 rounded $class"]) }}>
    {{ $slot }}
</div>
