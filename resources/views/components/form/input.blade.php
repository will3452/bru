@props(['label'=>'input label'])
<x-form.label>
    {{ $label }}
</x-form.label>
<input {{ $attributes->merge(['class' => 'form-control']) }}>