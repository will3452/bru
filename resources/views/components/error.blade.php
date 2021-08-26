@props(['name'=>'name'])
@error($name)
    <small class="text-danger text-help">
        {{ $message }}
    </small>
@enderror