@props(['label'=>'Label here', 'link'=>'#'])
<li class="nav-item">
    <a class="nav-link" href="{{ $link }}">
        {{ $slot }}
        <span>
            {{ $label }}
        </span>
    </a>
</li>
