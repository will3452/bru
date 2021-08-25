@props(['label'=>'', 'options'=>[]])
<x-form.label>
    {{ $label }}
</x-form.label>
<select  {{ $attributes->merge(['class' => 'custom-select']) }}>
    <x-form.option value="" selected disabled>---</x-form.option>
    @foreach ($options as $item)
        <x-form.option :value="$item['value']">
            {{ $item['label'] }}
        </x-form.option>
    @endforeach
</select>

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