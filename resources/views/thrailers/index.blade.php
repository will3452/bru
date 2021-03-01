@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of your Trailer') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div class="text-center mb-2">
        <a href="#" class="btn" id="all">All</a>
        <a href="#" class="btn" id="need">Need Approval</a>
        <a href="#" class="btn" id="appr">Approved</a>
    </div>
    <div class="row">
        @foreach($thrailers as $thrailer)

            <div class="col-md-4 all {{ empty($thrailer->approved) ? 'need_approved':'approved' }}">
                <div class="card mb-2" style="height:45vh">
                    <div class="card-header d-flex justify-content-between">
                        <div>
                            {{ $thrailer->title }}
                        </div>
                        <div>
                            <a href="{{ route('thrailers.edit', $thrailer) }}"><i class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <video class="video-js w-100" data-setup='{"poster":"{{ $thrailer->cover }}", "controls": true, "responsive":true, "autoplay": false, "preload": "auto"}'>
                        <source src="{{ $thrailer->video }}" type="video/mp4">
                        <source src="{{ $thrailer->video }}" type="video/webm">
                    </video>
                    <div class="card-footer d-flex justify-content-between">
                        <div>
                            <a href="#">1.k <i class="fa fa-heart"></i></a>
                        </div>
                        <div>
                            <a href="#">200 <i class="fa fa-comments"></i></a>
                        </div>
                        <div>
                            <a href="#">1.5M <i class="fa fa-eye"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/videojs/video-js.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <style>
        .video-js .vjs-big-play-button {
            left: 40% !important;
            top: 40% !important;
            width: 20%;
            /* height: 20%; */
        }

        .video-js .vjs-play-control:before {
            top:20% !important;
            content: '\f101';
            font-size: 48px;
        }
    </style>
@endsection

@section('bottom')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/videojs/video.min.js') }}"></script>
    <script>
        $(function(){
             $('.select2').select2();
             $('#all').click(function(){
                 $('.all').fadeIn(500);
             });
             $('#need').click(function(){
                $('.all').fadeOut(500);
                 $('.need_approved').fadeIn(1000);
             })
             $('#appr').click(function(){
                $('.all').fadeOut(500);
                 $('.approved').fadeIn(1000);
             })
        })
    </script>
    
@endsection
