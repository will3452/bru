@props(['label'=>'input label', 'name'=>'name'])
<x-form.label>
    {{ $label }}
</x-form.label>
<input {{ $attributes->merge([
    'class' => 'form-control',
    'name'=>$name
    ]) }}>
<x-error name="{{ $name }}"/>