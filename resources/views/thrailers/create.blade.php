@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Trailer') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('thrailers.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title" required>
        </div>
        <div class="form-group">
            <label for="">Author</label>
            <select name="author" id="" class="custom-select select2">
                @foreach(auth()->user()->pens as $pen)
                <option value="{{ $pen->name }}">
                    {{ $pen->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Please submit the video for approval to the Admin. </label>
            <input type="file" accept="video/*" class="d-block" name="video">

            <div class="alert alert-warning mt-2">
                <input type="checkbox" required name="cpy">
                @copyright_disclaimer
            </div>
        </div>
        <div class="form-group">
            <label for="">Type of Gem</label>
            <select name="gem" id="" class="select2 form-control">
                <option value="White">White Gems</option>
                <option value="Purple">Purple Gems</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Cost</label>
            <input type="number" name="cost" class="form-control" min="0" value="0">
        </div>
        <div class="form-group">
            <button class="btn btn-block btn-primary">
                Submit trailer
            </button>
        </div>
    </form>
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection

@section('bottom')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(function(){
             $('.select2').select2();
        })
    </script>
@endsection
