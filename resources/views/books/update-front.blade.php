@extends('layouts.admin')
@section('main-content')
    <h1>
        Upload 
    </h1>
    <div class="car card-body">
       <form action="{{ route('books.update.front', $id) }}" method="POST" enctype="multipart/form-data">
            @method('PUT')
           @csrf
        <div class="form-group">
            <input type="file" name="front" accept="application/pdf">
        </div>
        <button class="btn btn-primary">
            Upload now
        </button>
       </form>
    </div>
@endsection