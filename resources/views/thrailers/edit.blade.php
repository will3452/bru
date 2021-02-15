@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Update '.$thrailer->title) }}</h1>
    <a href="{{ route('thrailers.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('thrailers.update', $thrailer) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('put')
        <div class="form-group">
            <label for="">Title</label>
            <input type="text" class="form-control" name="title" required value="{{ $thrailer->title }}">
        </div>
        <div class="form-group">
            <label for="">Author</label>
            <select name="author" id="" class="custom-select select2">
                @foreach(auth()->user()->pens as $pen)
                <option value="{{ $pen->name }}">
                    {{ $pen->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="">Cost</label>
            <input type="number" min="0" name="cost" value="{{ $thrailer->cost }}" class="form-control">
        </div>
        <div class="form-group">
            <label for="">Type of Gem</label>
            <select name="gem" id="" class="custom-select select2">
                <option value="White" @if($thrailer->gem == 'White') selected @endif>White Gems</option>
                <option value="Purple" @if($thrailer->gem == 'Purple') selected @endif>Purple Gems</option>
            </select>
        </div>
        @empty($thrailer->approved)
        <div class="form-group">
            <label for="">Please enter code provided by Admin as approval of upload.</label>
            <input type="text" class="form-control " placeholder="Xy12ffdc" name="code">
        </div>
        @else
        <input type="hidden" name="code" value="{{ $thrailer->code }}">
        @endempty
        <div class="form-group">
            <button class="btn btn-block btn-primary">
                Update @empty($thrailer->approved) & Publish @endempty
            </button>
        </div>
    </form>
    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal"><i class="fa fa-trash"></i> Delete</button>
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="{{ route('thrailers.destroy', $thrailer) }}" method="POST">
                  @csrf
                  @method('delete')
                  <div class="form-group">
                      <label for="">Enter the password to continue</label>
                      <input type="password" class="form-control" name="password" placeholder="*****">
                  </div>
                  <div class="form-group">
                      <button class="btn btn-danger btn-block">Proceed</button>
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection

@section('bottom')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(function(){
             $('.select2').select2();
        })
    </script>
@endsection
