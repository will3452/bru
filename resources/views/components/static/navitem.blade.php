@props(['link'=>'#'])
<li class="navitem {{ url()->current() != $link?:'active' }}">
    <a href="{{ $link }}">
        {{ $slot }}
    </a>
</li>