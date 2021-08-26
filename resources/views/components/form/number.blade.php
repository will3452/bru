@props(['label'=>'', 'name'=>'name'])

<x-form.input type="number" label="{{ $label }}" name="{{ $name }}"
 oninput="validate(this)" value="{{ old('cost') ?? 0 }}" />
 <x-error name="{{ $name }}"/>
<script>
    function validate(input){
        if(input.value < 0){
            input.value = 0;
        }
    }
</script>