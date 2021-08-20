@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Podcast') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    <div class="d-flex mt-4 flex-wrap">
        @foreach ($podcasts as $book)
        <x-book-window :book="$book"/>
        @endforeach
    </div>
@endsection

@section('top')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection