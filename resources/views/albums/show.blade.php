@extends('layouts.admin')
@section('main-content')
    @livewireStyles()
    <h1 class="h3 mb-4 text-gray-800">{{$album->title }}</h1>
    <div class="d-flex justify-content-between">
        <a href="{{ route('albums.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    </div>
    @include('partials.alert')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Work
                </div>
                <div class="card-body">
                    @livewire('search-album', ['album'=>$album])
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    List of Work
                </div>
                <div class="card-body">
                    @if ($album->type == 'song')
                        @foreach ($album->songs as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('albums.update', $album) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="work_id" value="{{ $book->id }}">
                                 <button class="btn btn-danger btn-sm">
                                     remove
                                 </button>
                            </form>
                        </li>
                        @endforeach
                    @endif
                    @if ($album->type == 'art')
                        @foreach ($album->arts as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('albums.update', $album) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="work_id" value="{{ $book->id }}">
                                 <button class="btn btn-danger btn-sm">
                                     remove
                                 </button>
                            </form>
                        </li>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Album Information
                </div>
                <div class="card-body">
                    <div>
                        Title : {{ $album->title }} ( {{ $album->type }} )
                    </div>
                    <div>
                        Type of work: {{ $album->type_of_work }}
                    </div>
                    
                    <div>
                        Description : <br>
                        {!! $album->desc !!}
                    </div>
                    <div>
                        Credits: <br>
                        {!! $album->credits !!}
                    </div>
                    <div>
                        Cover : <a href="{{ $album->cover }}">
                            {{ \Str::limit($album->cover, 20) }}
                        </a>
                    </div>
                    <div class="mt-2">
                    </div>
                </div>
            </div>
        </div>
    </div>
    @livewireScripts()
@endsection




