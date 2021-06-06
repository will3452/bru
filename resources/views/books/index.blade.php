@extends('layouts.admin')
@section('main-content')
    <div class="card">
        <div class="card-header">
            Create
        </div>
        <div class="card-body">
            <a href="{{ route('books.create') }}" class="btn btn-primary"> <i class="fa fa-book"></i> Books</a>
            <a href="{{ route('arts.create') }}" class="btn btn-primary"> <i class="fa fa-image"></i> Art Scenes</a>
            <a href="{{ route('thrailers.create') }}" class="btn btn-primary"> <i class="fa fa-video"></i> Films</a>
            <a href="{{ route('songs.create') }}" class="btn btn-primary"> <i class="fa fa-music"></i> Songs</a>
            <a href="{{ route('audio.create') }}" class="btn btn-primary"> <i class="fa fa-file-audio"></i> Audio Book</a>
            <a href="{{ route('podcast.create') }}" class="btn btn-primary"> <i class="fa fa-podcast"></i> Podcast</a>
        </div>
    </div>
    <br>
    <div class="card">
        <div class="card-header">
            Listing
        </div>
        <div class="card-body">
            <a href="{{ route('books.list') }}" class="btn btn-primary"> <i class="fa fa-book"></i> Books</a>
            <a href="{{ route('arts.list') }}" class="btn btn-primary"> <i class="fa fa-image"></i> Art Scenes</a>
            <a href="{{ route('thrailers.index') }}" class="btn btn-primary"> <i class="fa fa-video"></i> Films</a>
            <a href="{{ route('songs.index') }}" class="btn btn-primary"> <i class="fa fa-music"></i> Songs</a>
            <a href="{{ route('audio.index') }}" class="btn btn-primary"> <i class="fa fa-file-audio"></i> Audio Book</a>
            <a href="{{ route('podcast.index') }}" class="btn btn-primary"> <i class="fa fa-podcast"></i> Podcast</a>
        </div>
    </div>
    
@endsection

@section('bottom')


@endsection