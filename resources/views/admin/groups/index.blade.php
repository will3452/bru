@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Groups') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
    </div>
    <div>
        @livewire('admin.group-list')
    </div>
@endsection

@section('top')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
@endsection