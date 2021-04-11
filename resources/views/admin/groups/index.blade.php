@extends('layouts.master')
@section('main-content')
    <div x-data="{createType:@if(isset(request()->createType)) true @else false @endif }">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-4 text-gray-800">{{ __('Groups') }}</h1>
            <button class="btn btn-primary btn-sm"  x-on:click="createType = !createType">
                    <i class="fa" :class="{'fa-angle-right':!createType, 'fa-angle-down':createType}"></i> 
                    Add Group Type
                </button>
        </div>
        <div class="card my-2" x-show.transition="createType">
            <div class="card-header">
                Add Group Type
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                    <form action="{{ route('admin.grouptypes.store') }}" method="post">
                        @csrf
                            <div class="input-group">
                                <input type="text" placeholder="Enter Group Type Here." name="name" class="form-control">
                                <button class="btn btn-primary input-group-append">Add</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 d-flex align-items-start" style="flex-wrap: wrap">
                        @foreach (\App\GroupType::get() as $item)
                            <div class="d-flex align-items-center text-white bg-primary p-1 px-2 rounded m-1">
                                <div class="mr-2">
                                    {{ $item->name }}
                                </div>
                                <form action="{{ route('admin.grouptypes.destroy', $item) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger rounded-circle btn-sm">
                                        <i class="fa fa-times"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
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