@extends('layouts.master')
@section('main-content')
    <div class="d-flex mb-2 align-items-center justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm "><i class="fa fa-angle-left"></i> Back</a>
        <a href="{{ route('admin.recom.remarks') }}" class="btn btn-primary btn-sm "> Remarks <i class="fa fa-angle-right"></i></a>
    </div>
    <div id="role-app">
        <div class="mt-2 ">
            <h3>Recommendation</h3>
        </div>
        @livewire('admin.recommendation-create')
        @livewire('admin.recommendation-list')
    </div>
@endsection

@section('top')
    @livewireStyles
@endsection

@section('bottom')
    @livewireScripts
@endsection


