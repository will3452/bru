@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="row">
        {{-- books --}}
        @livewire('dashboard-card', ['count'=>auth()->user()->books()->count(), 'item'=>'books', 'details'=>['Published'=>auth()->user()->books()->whereNotNull('publish_date')->count(), 'Not Published'=>auth()->user()->books()->whereNull('publish_date')->count()]])

        {{-- art scene --}}
        @livewire('dashboard-card', ['count'=>auth()->user()->arts()->count(), 'item'=>'Art scenes', 'details'=>[
            'Published'=>auth()->user()->arts()->count()
    ], 'icon'=>'fa-paint-brush', 'color'=>'danger'])

        {{-- aduio --}}
        @livewire('dashboard-card', ['count'=>auth()->user()->audio()->count(), 'item'=>'Audio books', 'details'=>[
            'Published'=>auth()->user()->audio()->whereNotNull('publish_date')->count(), 'Not Publish'=>auth()->user()->audio()->whereNull('publish_date')->count()
    ], 'icon'=> 'fa-headset', 'color'=>'success'])

        {{-- films --}}
        @livewire('dashboard-card', ['count'=>auth()->user()->thrailers()->count(), 'item'=>'Films', 'details'=>[
            'Published'=>auth()->user()->thrailers()->whereNotNull('approved')->count(),
            'Not Published'=>auth()->user()->thrailers()->whereNull('approved')->count()
    ], 'icon'=>'fa-film', 'color'=>'secondary'])
    </div>
    
@endsection

@section('top')
    
    <script src="{{asset('/js/app.js')}}"></script>

@endsection
