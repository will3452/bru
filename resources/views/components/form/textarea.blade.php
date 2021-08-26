@props(['label'=>'label', 'name'=>'name'])
<x-form.label>
    {{ $label }}
</x-form.label>
<textarea 
{{ $attributes->merge([
    'name'=>$name
]) }}>
    {{ $slot }}
</textarea>
<x-error name="{{ $name }}"/>
<script>
    CKEDITOR.replace('{{ $name }}');
</script>