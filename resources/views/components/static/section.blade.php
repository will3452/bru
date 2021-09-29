@props(['iswhite'=>false])
@if(!$iswhite)
    <div class="section">
        {{ $slot }}
    </div>
@else
    <div class="section" style="background: #fff !important; color: #222 !important;">
        {{ $slot }}
    </div>
@endif
