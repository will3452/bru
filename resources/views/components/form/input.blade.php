@props(['label'=>'input label', 'name'=>'name', 'value'=>''])
<x-form.label>
    {{ $label }}
</x-form.label>
<input {{ $attributes->merge([
    'class' => 'form-control',
    'name'=>$name,
    'value'=>$value == '' ? old($name) : $value,
    ]) }}>
<x-error name="{{ $name }}"/>