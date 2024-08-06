@php
    $classes = "hover:underline"
@endphp
@props(['to' => '#', 'target' => '_blank'])
<a href="{{ $to }}" {{ $attributes(['class' => $classes]) }} target="{{ $target }}">
    {{ $slot }}
</a>
