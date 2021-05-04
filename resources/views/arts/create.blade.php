@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Art Scene') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('arts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h5>Art Details</h5>
        <div class="form-group">
            <label for="">Art Scene Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>
        <div class="form-group">
            <label for="">Art Scene Description</label>
            <textarea name="desc" id="" cols="30" rows="10" class="form-control">{{ old('description') }}</textarea>
        </div>
        <div class="form-group">
            <label for="">Pen Name</label>
            <select name="artist" id="" class="form-control">
                @foreach(auth()->user()->pens as $pen)
                <option value="{{ $pen->name }}">
                {{ $pen->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="#">Genre</label>
            <select name="genre" id="" class="form-control">
                @foreach(\App\Genre::get() as $genre)
                    @continue($genre->name == 'Poetry')
                <option value="{{ $genre->name }}">{{ $genre->name }}</option>
                @endforeach
            </select>
        </div>
        <div >
            <label for="">Set Age Restriction</label>
            <select name="age_restriction" id="age_level" class="form-control">
                <option value="0">
                    None
                </option>
                <option value="16">
                    16 and up
                </option>
                <option value="18" id="_18">
                    18 and up
                </option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Tags</label>
            <select name="tag[]" id="tag" multiple class="form-control">
            </select>
            <div class="alert alert-warning d-flex align-items-center mt-2">
                <i class="fa fa-info-circle mr-2"></i>
                <div>Please list down TEN tags for your Art Scene. These tags will ensure better SEO and reading recommendations based on user search and account information. </div>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Lead's College</label>
            <select class="form-control" name="lead_college">
                <option value="Integrated School">Integrated School</option>
                <option value="Berkeley">Berkeley</option>
                <option value="Reagan">Reagan</option>
                <option value="Non-BRU">Non-BRU</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Credits</label>
            <textarea name="credits" id=""></textarea>
        </div>
        <div class="form-group">
            <label for="#">Cost</label>
            <input type="number" name="cost" class="form-control" min="0" oninput="validate(this)" value="{{ old('cost') ?? 0 }}">
            <script>
                function validate(input){
                   if(input.value < 0){
                      input.value = 0;
                   }
                }
            </script>
        </div>
        <h5>Upload Art</h5>
        <div class="form-group">
            <div class="custom-file">
                <label class="custom-file-label" for="art">Choose from file</label>
                <input type="file" name="file" id="art" accept="image/*" required class="custom-file-input">
            </div>
        </div>
        <div class="alert alert-warning mt-2">
            <div>
                <strong>Required*</strong>
            </div>
            <input type="checkbox" id="ck_box3" name="cpy" required>
            @copyright_disclaimer
        </div>
        <button class="btn btn-primary btn-block">Submit</button>
    </form>
@endsection

@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(function(){
            $.fn.select2.defaults.set( "theme", "bootstrap" );
            $('select').select2();
            $('#tag').select2({
                tags:true,
                tokenSeparators: [',', ' ']
            });

            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            //rich editor
            CKEDITOR.replace('desc');
            CKEDITOR.replace('credits');
        })
    </script>
@endsection