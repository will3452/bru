@extends('layouts.admin')
@section('main-content')
    <h1>
        Upload  .PDF file that contain your BOOK TITLE PAGE, COPYRIGHT PAGE, ACKNOWLEDGMENT PAGE AND DEDICATION PAGE
    </h1>
    <div class="car card-body">
       <form action="{{ route('books.update-front', $id) }}" enctype="multipart/form-data">
            @method('PUT')
           @csrf
        <div>
            <input type="file" name="front" accept="application/pdf">
        </div>
        <button class="btn btn-primary">
            Upload now
        </button>
       </form>
    </div>
@endsection