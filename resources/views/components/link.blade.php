@props(['url'])
<a
    {{ $attributes->merge([
        'href'=>$url
    ]) }}
>
    {{ $slot }}
</a>