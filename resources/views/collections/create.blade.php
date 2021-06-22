@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create a Collection') }}</h1>
    <a href="{{ route('collections.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="">
                Is this a solo collection or a collaboration? 
            </label>
            <select name="type_of_work" id="" class="custom-select">
                <option value="solo">Solo</option>
                <option value="collaboration">Collaboration</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Collection Title</label>
            <input type="text" class="form-control" required name="title">
        </div>
        <div class="form-group">
            <label for="">
                Collection Description
            </label>
            <textarea name="desc" id="" cols="30" rows="10" required></textarea>
        </div>
        <div class="form-group">
            <label for="">
                Collection Credits
            </label>
            <textarea name="credits" id=""  required cols="30" rows="10"></textarea>
        </div>
        <div class="form-group">
            <label for="">
                Upload Collection Cover
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
