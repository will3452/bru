@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Events') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        {{-- <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Create new event</a> --}}
    </div>
    
@endsection