@extends('layouts.admin')
@section('main-content')
    <h1>{{ $thrailer->title }}</h1>
    @if (!$thrailer->approved)
        <div x-data="{viewForm:false}">
            <div class="alert alert-warning">
                This Film / Thrailer is not yet approved. click <a href="#" x-on:click.prevent="viewForm = true">HERE</a> to enter your approval CODE.
            </div>
            <div x-show="viewForm">
                <form action="#">
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            Verify
                        </button>
                        <button class="btn btn-danger" x-on:click.prevent="viewForm = false">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Trailer / Film details
                </div>
                <div class="card-body">
                    <form action="#">
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" disabled value="{{ $thrailer->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Cost</label>
                            <input type="text" disabled value="{{ $thrailer->cost }}" class="form-control">
                        </div> 
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="description" id="" cols="30" rows="5" class="form-control">{{ $thrailer->description }}</textarea>
                        </div>          
                        <div class="form-group">
                            <label for="">Credits</label>
                            <textarea name="credit" id="" cols="30" rows="5" class="form-control">{{ $thrailer->credit }}</textarea>
                        </div>
                        <div class="form-group" x-data="{changeCover:false}">
                            <a href="" class="btn btn-success btn-sm">View Cover</a>
                            <a href="#" class="btn btn-secondary btn-sm" x-on:click.prevent="changeCover = !changeCover">
                                <span x-show="!changeCover">Change Cover</span>
                                <span x-show="changeCover"><i class="fa fa-times"></i></span>
                            </a>
                            <div class="mt-2" x-show="changeCover">
                                <input type="file" accept="image/*" name="cover">
                            </div>
                        </div>   
                        <div class="form-group">
                            <a href="{{ $thrailer->video }}"> <i class="fa fa-film fa-sm"></i> Show Video</a>
                        </div>      
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Reports
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div>
    </div>
@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
@endsection
