@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Books') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    <div class="alert alert-info">
        <i class="fa fa-bell"></i> <span>Hi, {{ auth()->guard('admin')->user()->full_name }}! This list shows all books created by scholars, whether published or not. For monitoring purposes. </span>
    </div>
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Cover
                </th>
                <th>
                    
                    Title
                </th>
                <th>
                    Class
                </th>
                <th>
                    Category
                </th>
                <th>
                    Language
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th>
                    Status
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $key=>$book)
            <tr>
                <td class="d-flex justify-content-center"><img src="{{ $book->cover}}"  style="object-fit:cover;" class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    <a href="{{ route('admin.books.show', $book) }}">{{ $book->title }} <i class="fa fa-link fa-xs"></i></a>
                </td>
                <td>{{  $book->class }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->language }}</td>
                <td>{{ $book->cost }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>{!! $book->ispublic ? '<i class="fa fa-check fa-xs" ></i> Published':'<i class="fa fa-times fa-xs" ></i> Unpublished'!!}</td>
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
            // 'copy', 'csv', 'excel', 'pdf','colvis'
             'pdf','colvis'
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>
@endsection