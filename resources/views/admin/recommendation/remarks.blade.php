@extends('layouts.master')
@section('main-content')
    <div class="d-flex mb-2 align-items-center justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm "><i class="fa fa-angle-left"></i> Back</a>
    </div>
    <div id="role-app">
       @livewire('recommendation.create-remarks')
       @livewire('recommendation.list-remarks')

    </div>
@endsection

@section('top')
    @livewireStyles
@endsection

@section('bottom')
    @livewireScripts
@endsection


