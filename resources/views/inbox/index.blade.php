@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Inbox') }}</h1>
    <a href="{{ route('home') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    @if (count($messages))
    <ul class="list-group">
        @foreach ($messages as $message)
            <x-inbox-card :message="$message"/>
        @endforeach
    </ul>

    @else
    <p class="alert alert-secondary">
        No Message.
    </p>
    @endif
@endsection