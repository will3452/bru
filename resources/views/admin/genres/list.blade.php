@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Genres') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Icon</th>
            </tr>
        </thead>
        <tbody>
            @foreach($genres as $genre)
            <tr>
                <td>
                    {{ $genre->id }}
                </td>
                <td>
                    <a href="{{ route('admin.genres.show', $genre) }}">{{ $genre->name }} <i class="fa fa-link fa-xs"></i></a>
                </td>
                <td>
                    <i class="fa {{ $genre->icon ?? '' }}"></i>
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
@endsection
@section('bottom')
<script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.colVis.min.js"></script>
    <script>
        $(function(){
            $('#bookstable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf','colvis'
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>

@endsection