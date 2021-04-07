@extends('layouts.master')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Show Genre</h1>
    <a href="{{ route('admin.genres.list') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    
    <div class="card card-body shadow" style="text-transform: capitalize">
        <form action="{{ route('admin.genres.update', $genre) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="">Genre Name</label>
                <input type="text" class="form-control" name="name" value="{{ $genre->name }}">
            </div>
            <div class="form-group">
                <label for="">Genre Icon</label> 
                <input type="text" class="form-control" name="icon" value="{{ $genre->icon }}" placeholder="input icon code">
                <small><a href="#">Select icon code here</a></small>
            </div>
            <div class="form-group">
                <label for="">Description</label>
                <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $genre->description }}</textarea>
            </div>
            <div class="form-group row">
                <div class="col-md-6">
                    <label for=""><i class="fa fa-fire"></i> Heat Level</label>
                    <div>
                        <label for="" class="d-block">
                            <input type="checkbox" name="heat[]" {{ in_array('Level - 1 Sweet@0', $genre->heats) ? 'checked':'' }} value="Level - 1 Sweet@0" class="resetme heat_check"> Level 1 - Sweet / none
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="heat[]" {{ in_array('Level - 2 Romantic@16', $genre->heats) ? 'checked':'' }} value="Level - 2 Romantic@16" class="resetme heat_check"> Level 2 - Romantic / 16+
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="heat[]" {{ in_array('Level - 3 Steamy@18', $genre->heats) ? 'checked':'' }} value="Level - 3 Steamy@18" class="resetme heat_check"> Level 3 - Steamy / 18+
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="heat[]" {{ in_array('Level - 4 Erotic Romance@18', $genre->heats) ? 'checked':'' }} value="Level - 4 Erotic Romance@18" class="resetme heat_check"> Level 4 - Erotic Romance / 18+
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="heat[]" {{ in_array('Level - 5 Erotica@18', $genre->heats) ? 'checked':'' }} value="Level - 5 Erotica@18" class="resetme heat_check"> Level 5 - Erotica / 18+
                        </label>
                        <label for="">
                            <input type="checkbox" onchange="$('.heat_check').prop('checked', !$('.heat_check').prop('checked'))"> Select/Unselect All
                        </label>
                    </div>
                </div>
                <div class="col-md-6">
                    <label for=""><i class="fa fa-bolt"></i> Violence Level</label>
                    <div>
                        <label for="" class="d-block">
                            <input type="checkbox" name="violence[]" {{ in_array('Level - 1 Non-violent@0', $genre->violences) ? 'checked':'' }} value="Level - 1 Non-violent@0" class="resetme vio_check"> Level 1 - Non-violent / none
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="violence[]" {{ in_array('Level - 2 Violent@16', $genre->violences) ? 'checked':'' }} value="Level - 2 Violent@16" class="resetme vio_check"> Level 2 - Violent / 16+
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="violence[]" {{ in_array('Level - 3 Bloody@18', $genre->violences) ? 'checked':'' }} value="Level - 3 Bloody@18" class="resetme vio_check"> Level 3 - Bloody / 18+
                        </label>
                        <label for="" class="d-block">
                            <input type="checkbox" name="violence[]" {{ in_array('Level - 4 Gruesome@18', $genre->violences) ? 'checked':'' }} value="Level - 4 Gruesome@18" class="resetme vio_check"> Level 4 - Gruesome / 18+
                        </label>
                        <label for="">
                            <input type="checkbox" onchange="$('.vio_check').prop('checked', !$('.vio_check').prop('checked'))"> Select/ Unselect All
                        </label>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label for="" style="text-transform:none;">
                    <input type="checkbox" name="age_restriction" {{ $genre->age_restriction != null ? 'checked':''}} id="age" > Just set Age Restriction
                </label>
            </div>
            <div class="form-group text-center">
                <button class="btn btn-primary">Update</button>
            </div>
        </form>
    </div>

@endsection


@section('bottom')
    <script>
        $(function(){
            $('#age').change(function(){
                if($(this).prop('checked')){
                    $('.resetme').prop('checked', false);
                }
            })
            $('.resetme').change(function(){
                if($(this).prop('checked')){
                    $('#age').prop('checked', false);
                }
            })
        })
    </script>
@endsection