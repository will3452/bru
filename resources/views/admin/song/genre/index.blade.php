@extends('layouts.master')
@section('main-content')
<a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>

    <div x-data="{showCreate:false}">
        <div class="d-flex justify-content-between align-items-center" >
            <h1 class="h3 mb-4 text-gray-800">{{ __('List of Genres') }}</h1>
            <a href="#" class="btn btn-primary" x-on:click="showCreate = !showCreate" >
                <div x-text="!showCreate ? 'Add New Genre':'Cancel'"></div>
            </a>
        </div>
        <div x-show.transition = "showCreate" class="card card-body my-2">
                <form action="{{ route('admin.songsgenre.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Genre Name</label>
                        <input type="text" class="form-control" name="name" required>
                    </div>
                    {{-- <div class="form-group">
                        <label for="">Genre Icon</label> 
                        <input type="text" class="form-control" name="icon"  placeholder="input icon code">
                        <small><a href="#">Select icon code here</a></small>
                    </div> --}}
                    {{-- <div class="form-group">
                        <label for="">Description</label>
                        <textarea name="description" id="" cols="30" rows="5" class="form-control"></textarea>
                    </div> --}}
                    <div class="form-group text-center">
                        <button class="btn btn-primary btn-block">Add</button>
                    </div>
                </form>
        </div>
    </div>
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Delete</th>
            </tr>
        </thead>
        <tbody>
            @foreach($songGenres as $genre)
            <tr>
                <td>
                    {{ $genre->id }}
                </td>
                <td>
                    {{ $genre->name }}
                </td>
                <td>
                    <form action="{{ route('admin.songsgenre.destroy', $genre) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

@endsection
@section('bottom')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script> --}}
    <script>
        $(function(){
            $('#bookstable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf','colvis'
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>

@endsection