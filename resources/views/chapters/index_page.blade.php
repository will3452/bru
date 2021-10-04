@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('LIST OF PDF PAGES') }}</h1>
    <div class="d-flex justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
        <a href="/chapter-page/{{$chapter->id}}" class="btn btn-primary btn-sm mb-2">Upload New Page</a>
    </div>
    @include('partials.alert')
    <ul class="list-group">
        @forelse ($chapter->chapterPages as $key=>$page)
            <li class="list-group-item d-flex justify-content-between">
                <div>
                    Page {{$key + 1}}
                </div>
                <div>
                    <a href="/chapter-page/{{$page->id}}" class="btn btn-primary btn-sm">show</a>
                    <form action="/chapter-page/{{$page->id}}" class="d-inline" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">remove</button>
                    </form>
                </div>
            </li>
        @empty
            <li>No Page Uploaded</li>
        @endforelse
    </ul>
@endsection
