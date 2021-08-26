@props(['label'=>'', 'options'=>[], 'default'=>'', 'name'=>'name'])
<x-form.label>
    {{ $label }}
</x-form.label>
<select  {{ $attributes->merge([
    'class' => 'custom-select',
    'name'=>$name
    ]) }}>
    
    @if ($default=='' || $default==null)
        <x-form.option value="" selected disabled>---</x-form.option>
    @endif
    
    @foreach ($options as $item)
        <x-form.option :value="$item['value']">
            {{ $item['label'] }}
        </x-form.option>
    @endforeach
</select>
<x-error name="{{ $name }}"/>
{{-- 
<x-form.select label="Pay With" :options="[
                [
                    'value'=>'gcash',
                    'label'=>'Gcash'
                ],
                [
                    'value'=>'bdo',
                    'label'=>'BDO'
                ]
            ]"/> --}}