@extends('layouts.admin')
@section('main-content')
@if (auth()->user()->pens()->count() == 0)
    <script>
        window.location.href = '{{ route('profile') }}';
    </script>
@endif
    <h1 class="h3 mb-4 text-gray-800">{{ __('My Works') }}</h1>
    <div class="row">
        
        <x-dashboard-card>
            <div class="row no-gutters align-items-center">
                <div class="col mr-2 text-truncate">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1"><a href="#" data-toggle="modal" data-target="#createModal" id="create-link">Create</a></div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('img/icons/create.png') }}" alt="" class="icon-xl">
                </div>
            </div>
        </x-dashboard-card>
        
        <x-dashoard-card>
            <div class="row no-gutters align-items-center">
                <div class="col mr-2 text-truncate">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1"><a href="#" data-target="#listModal" data-toggle="modal">List</a></div>
                </div>
                <div class="col-auto">
                    <img src="{{ asset('img/icons/list.png') }}" alt="" class="icon-xl">
                </div>
            </div>
        </x-dashoard-card>

        <x-dashboard-card>
            <div class="row no-gutters align-items-center">
                <div class="col mr-2 text-truncate">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1"><a href="{{ route('series.index') }}" >Series</a></div>
                </div>
                <div class="col-auto" style="font-size:34px;">
                    <i class="fa fa-layer-group"></i>
                </div>
            </div>
        </x-dashboard-card>

        <x-dashboard-card>
            <div class="row no-gutters align-items-center">
                <div class="col mr-2 text-truncate">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1"><a href="{{ route('collections.index') }}" >Collections</a></div>
                </div>
                <div class="col-auto" style="font-size:34px;">
                    <i class="fa fa-grip-horizontal"></i>
                </div>
            </div>
        </x-dashboard-card>
        
        <x-dashboard-card>
            <div class="row no-gutters align-items-center">
                <div class="col mr-2 text-truncate">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1"><a href="{{ route('albums.index') }}" >Albums</a></div>
                </div>
                <div class="col-auto" style="font-size:34px;">
                    <i class="fa fa-compact-disc"></i>
                </div>
            </div>
        </x-dashboard-card>
    </div>
    <div class="modal fade " id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog " role="document">
        <div class="modal-content modal-bg-custom">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <a href="{{ route('books.create') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/book.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">
                Book</span></a>
            <a href="{{ route('audio.create') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/audiobook.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">
                    Audio Book</span></a>
            <a href="{{ route('arts.create') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/art.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">Art Scene</span></a>
            <a href="{{ route('thrailers.create') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/trailer.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">Film</span></a>
            <a href="{{ route('songs.create') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/music.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">Song</span></a>
            <a href="{{ route('podcast.create') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><i class="fa fa-podcast m-2" style="font-size:300%"></i> <span style="font-size:200%"> Podcast</span></a>
        </div>
        </div>
    </div>
    </div>

    <div class="modal fade" id="listModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content modal-bg-custom">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">List</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <a href="{{ route('books.list') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/book.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">
                Book</span></a>
            <a href="{{ route('audio.index') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/audiobook.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">
                Audio Book</span></a>
            <a href="{{ route('arts.list') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/art.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">Art Scene</span></a>
            <a href="{{ route('thrailers.index') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/trailer.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">Film</span></a>
            <a href="{{ route('songs.index') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><img src="{{ asset('img/icons/music.png') }}" alt="" class="icon-xl"> <span style="font-size:200%">Song</span></a>
            <a href="{{ route('podcast.index') }}" class="btn mb-2 btn-outline-primary d-block text-left d-flex align-items-center"><i class="fa fa-podcast m-2" style="font-size:300%"></i> <span style="font-size:200%"> Podcast</span></a>
        </div>
        </div>
    </div>
    </div>
@endsection
