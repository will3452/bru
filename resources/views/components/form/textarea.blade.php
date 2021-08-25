@props(['label'=>'label', 'name'=>'desc'])
<x-form.label>
    {{ $label }}
</x-form.label>
<textarea 
{{ $attributes->merge([
    'name'=>$name
]) }}>
    {{ $slot }}
</textarea>

<script>
    CKEDITOR.replace('{{ $name }}');
</script>