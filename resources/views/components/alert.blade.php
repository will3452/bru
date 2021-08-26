@props(['color'=>'warning'])
<div class="alert alert-{{ $color }}">
    {{ $slot }}
</div>