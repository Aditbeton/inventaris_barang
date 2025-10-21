@props(['active'])

@php
    $classes = $active ? 'active text-danger' : '';
@endphp

<a {{ $attributes->merge(['class' => 'nav-link ' . $classes]) }}>
    {{ $slot }}
</a>
