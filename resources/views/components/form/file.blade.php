@props(['label'=>'Choose from file', 'key'=>'key'.\Str::random(), 'name'=>'name'])
<div class="custom-file">
    <label class="{{ $key }}-label custom-file-label">{{ $label }}</label>
    <input 
    {{ $attributes->merge([
        'type'=>'file',
        'class'=>$key.'-input custom-file-input',
        'name'=>$name
    ]) }}
    >
</div>
<x-error name="{{ $name }}" />
<script>
    let {{ $key }}LabelCustom = document.querySelector('.{{ $key }}-label');
    document.querySelector('.{{ $key }}-input').addEventListener('change', function (e) {
        var {{ $key }}fileName = e.target.value.split('\\').pop();
        {{ $key }}LabelCustom.classList.add('selected');
        {{ $key }}LabelCustom.innerText = {{ $key }}fileName;
    });
</script>