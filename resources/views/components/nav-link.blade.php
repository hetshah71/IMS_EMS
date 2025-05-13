

@props(['active' => false])
<a {{ $attributes->merge([
    'class' => 'block px-6 py-3 ' . ($active ? 'bg-gray-700 text-white' : 'text-white hover:bg-gray-700 transition')
]) }}
    aria-current="{{ $active ? 'page' : 'false' }}">
    {{ $slot }}
</a>