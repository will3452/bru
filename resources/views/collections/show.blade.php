@extends('layouts.admin')
@section('main-content')
    @livewireStyles()
    <h1 class="h3 mb-4 text-gray-800">{{$collection->title }}</h1>
    <div class="d-flex justify-content-between">
        <a href="{{ route('collections.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    </div>
    @include('partials.alert')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Work
                </div>
                <div class="card-body">
                    @livewire('search-collection', ['collection'=>$collection])
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    List of Work
                </div>
                <div class="card-body">
                    @if ($collection->books)
                        @foreach ($collection->books as $book)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $book->title }} (Book)
                                </div>
                                <form action="{{ route('collections.update', $collection) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="type" value="book">
                                    <input type="hidden" name="work_id" value="{{ $book->id }}">
                                    <button class="btn btn-danger btn-sm">
                                        remove
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    @endif

                    @if ($collection->arts)
                        @foreach ($collection->arts as $book)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $book->title }} (Art)
                                </div>
                                <form action="{{ route('collections.update', $collection) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="type" value="art">
                                    <input type="hidden" name="work_id" value="{{ $book->id }}">
                                    <button class="btn btn-danger btn-sm">
                                        remove
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    @endif

                    @if ($collection->films)
                        @foreach ($collection->films as $book)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $book->title }} (Film)
                                </div>
                                <form action="{{ route('collections.update', $collection) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="type" value="film">
                                    <input type="hidden" name="work_id" value="{{ $book->id }}">
                                    <button class="btn btn-danger btn-sm">
                                        remove
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    @endif

                    @if ($collection->audios)
                        @foreach ($collection->audios as $book)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $book->title }} (Audio Book)
                                </div>
                                <form action="{{ route('collections.update', $collection) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="type" value="audio book">
                                    <input type="hidden" name="work_id" value="{{ $book->id }}">
                                    <button class="btn btn-danger btn-sm">
                                        remove
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    @endif

                    @if ($collection->songs)
                        @foreach ($collection->songs as $book)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $book->title }} (Song)
                                </div>
                                <form action="{{ route('collections.update', $collection) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="type" value="song">
                                    <input type="hidden" name="work_id" value="{{ $book->id }}">
                                    <button class="btn btn-danger btn-sm">
                                        remove
                                    </button>
                                </form>
                            </li>
                        @endforeach
                    @endif

                    @if ($collection->podcasts)
                        @foreach ($collection->podcasts as $book)
                            <li class="list-group-item d-flex justify-content-between">
                                <div>
                                    {{ $book->title }} (Podcast)
                                </div>
                                <form action="{{ route('collections.update', $collection) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="type" value="podcast">
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
                    Collection Information
                </div>
                <div class="card-body">
                    <div>
                        Title : {{ $collection->title }} 
                    </div>
                   
                    <div>
                        Description : <br>
                        {!! $collection->desc !!}
                    </div>
                    <div>
                        Credits: <br>
                        {!! $collection->credits !!}
                    </div>
                    <div>
                        Cover : <a href="{{ $collection->cover }}">
                            {{ \Str::limit($collection->cover, 20) }}
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




