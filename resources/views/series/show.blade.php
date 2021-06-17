@extends('layouts.admin')
@section('main-content')
    @livewireStyles()
    <h1 class="h3 mb-4 text-gray-800">{{$series->title }}</h1>
    <div class="d-flex justify-content-between">
        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    </div>
    @include('partials.alert')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Work
                </div>
                <div class="card-body">
                    @livewire('search-series', ['series'=>$series])
                </div>
            </div>
            <div class="card mt-2">
                <div class="card-header">
                    List of Work
                </div>
                <div class="card-body">
                    @if ($series->type == 'book')
                        @foreach ($series->books as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('series.update', $series) }}" method="POST">
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

                    @if ($series->type == 'audio book')
                        @foreach ($series->audios as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('series.update', $series) }}" method="POST">
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

                    @if ($series->type == 'film')
                        @foreach ($series->films as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('series.update', $series) }}" method="POST">
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

                    @if ($series->type == 'podcast')
                        @foreach ($series->podcasts as $book)
                        <li class="list-group-item d-flex justify-content-between">
                            {{ $book->title }}
                            <form action="{{ route('series.update', $series) }}" method="POST">
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
                    Series Information
                </div>
                <div class="card-body">
                    <div>
                        Title : {{ $series->title }} ( {{ $series->type }} Series )
                    </div>
                    <div>
                        Type of work: {{ $series->type_of_work }}
                    </div>
                    
                    <div>
                        Description : <br>
                        {!! $series->desc !!}
                    </div>
                    <div>
                        Credits: <br>
                        {!! $series->credits !!}
                    </div>
                    <div>
                        Cover : <a href="{{ $series->cover }}">
                            {{ \Str::limit($series->cover, 20) }}
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




