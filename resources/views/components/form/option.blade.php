@props(['value'=>''])
<option {{ $attributes->merge(['value'=>$value]) }}>
    {{ $slot }}
</option>