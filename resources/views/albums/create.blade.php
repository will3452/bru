@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create an Album') }}</h1>
    <a href="{{ route('albums.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @livewire('album-create')
        <div class="form-group">
            <label for="">Album Title</label>
            <input type="text" class="form-control" required name="title">
        </div>
        <div class="form-group">
            <label for="">
                Album Description
            </label>
            <textarea name="desc" id="" cols="30" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <label for="">
                Album Credits
            </label>
            <textarea name="credits" id=""  required cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="">
                Upload Album Cover
            </label>
            <input type="file" name="cover" class="d-block" accept="image/*" required>
            <div class="alert alert-warning mt-2">
                <div>
                    <strong>Required*</strong>
                </div>
                <input type="checkbox" required id="ck_box" name="cpy" accept="image/*">
                @copyright_disclaimer
            </div>
        </div>
        <div class="form-group">
            <button class="btn btn-primary btn-block">
                Submit
            </button>
        </div>

    </form>
@endsection

@section('top')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('bottom')
    <script>
        CKEDITOR.replace('desc');
        CKEDITOR.replace('credits');
    </script>
@endsection
