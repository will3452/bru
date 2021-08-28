@extends('layouts.admin')
@section('main-content')
<h1 class="h3 mb-4 text-gray-800">{{ __('Create a Film') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('thrailers.store') }}" method="POST" enctype="multipart/form-data">
    {{-- <form action="#"> --}}
    @csrf
    <div class="form-group">
        <label for="">Title</label>
        <input type="text" class="form-control" name="title" required>
    </div>
    <div class="form-group">
        <label for="">Pen Name</label>
        <select name="author" id="" class="custom-select select2">
            @foreach(auth()->user()->pens as $pen)
            <option value="{{ $pen->name }}">
                {{ $pen->name }}
            </option>
            @endforeach
        </select>
    </div>
    
    <div class="form-group">
        <label for="">Description</label>
        <textarea name="desc" id="" required class="form-control"></textarea>
    </div>
    <div class="form-group">
        <label for="">Credits</label>
        <div class="alert alert-info">
            <i class="fa fa-info-circle"></i> This will appear as a page after the video.
        </div>
        <textarea name="credit" id="" required class="form-control"></textarea>
    </div>
    @livewire('film-create')
    <hr>
    <div class="form-group">
        <label for="">Age Restriction</label>
        <select name="age_restriction" id="" class="custom-select">
            <option value="none">None</option>
            <option value="15">15 and Up</option>
            <option value="18">18 and Up</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Language</label>
        <select name="language" id="" class="custom-select" required>
            <option value="english">English</option>
            <option value="filipino">Filipino</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Cover</label>
        <div>
            <input type="file" name="cover" accept="image/*" required>
        </div>
        <div class="alert alert-warning mt-2">
            <div>
                <strong>Required*</strong>
            </div>
            <input type="checkbox" required id="ck_box" name="cpy">
            @copyright_disclaimer
        </div>
    </div>

    <x-form.group>
        <x-card header="TRAILER | FILM | ANIMATION UPLOAD">
            <x-form.upload
            label="Please submit the video for the approval to the Admin."
            chunk="500kb"
            limit="800mb"
            title="video file"
            ext="mp4,flv,avi,mkv,mov"
            name="video"
            required
            />
        </x-card>
    </x-form.group>

    <x-form.group>
        <x-copyright-disclaimer/>
    </x-form.group>
    
    <div class="form-group">
        <label for="">Type of Crystal</label>
        <select name="gem" id="" class="select2 form-control">
            <option value="White">White Crystal</option>
            <option value="Purple">Purple Crystal</option>
        </select>
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
    <div class="form-group">
        <button class="btn btn-block btn-primary" id="submit">
            Submit
        </button>
    </div>
</form>
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <x-vendor.pupload/>
    @livewireStyles
@endsection

@section('bottom')
    @livewireScripts
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(function(){
             $('.select2').select2();
        });
    </script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>

    <script>
        CKEDITOR.replace('desc',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        }
      ],});
      CKEDITOR.replace('credit',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        }
      ],});
    </script>
@endsection
