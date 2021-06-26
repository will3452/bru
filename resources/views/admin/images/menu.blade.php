@extends('layouts.master')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800"><i class="fa fa-image"></i> Image management</h1>
    </div>
    <div>
        <a href="{{ route('admin.images.announcement') }}">Announcement</a> | 
        <a href="">Banners in sliders</a> | 
        <a href="">Preloaders</a> | 
        <a href="">Newspapers</a> | 
        <a href="">Bulletin</a>
    </div>
@endsection
