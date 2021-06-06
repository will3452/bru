@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{$series->title }}</h1>
    <div class="d-flex justify-content-between">
        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    </div>
    @include('partials.alert')
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Add Work
                </div>
                <div class="card-body">
                    @livewire('search-series')
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Series Information
                </div>
                <div class="card-body">
                    <div>
                        Title : {{ $series->title }} ( {{ $series->type }} Series )
                    </div>
                    <div>
                        Type of work: {{ $series->type_of_work }}
                    </div>
                    
                    <div>
                        Description : <br>
                        {!! $series->desc !!}
                    </div>
                    <div>
                        Credits: <br>
                        {!! $series->credits !!}
                    </div>
                    <div>
                        Cover : <a href="{{ $series->cover }}">
                            {{ \Str::limit($series->cover, 20) }}
                        </a>
                    </div>
                    <div class="mt-2">
                        <a href="" class="btn btn-primary">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection



