@props(['label'=>'Choose from file', 'key'=>'key'.\Str::random()])
<div class="custom-file">
    <label class="{{ $key }}-label custom-file-label">{{ $label }}</label>
    <input 
    {{ $attributes->merge([
        'type'=>'file',
        'class'=>$key.'-input custom-file-input'
    ]) }}
    >
</div>
<script>
    let {{ $key }}LabelCustom = document.querySelector('.{{ $key }}-label');
    document.querySelector('.{{ $key }}-input').addEventListener('change', function (e) {
        var {{ $key }}fileName = e.target.value.split('\\').pop();
        {{ $key }}LabelCustom.classList.add('selected');
        {{ $key }}LabelCustom.innerText = {{ $key }}fileName;
    });
</script>