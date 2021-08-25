@props(['type'=>'button', 'color'=>'primary'])
<button type="{{ $type }}" class="btn btn-{{ $color }} btn-sm">
    {{ $slot }}
</button>