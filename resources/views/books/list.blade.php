@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Books') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
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
                    Type
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
                    Is Published
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($books as $key=>$book)
            <tr>
                <td class="d-flex justify-content-center"><img src="{{ $book->cover}}" style="object-fit:cover;"  class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    <a href="{{ route('books.show', $book) }}">{{ $book->title }} <i class="fa fa-link fa-xs"></i></a>
                </td>
                <td>{{  $book->class }}</td>
                <td>{{ $book->category }}</td>
                <td>{{ $book->language }}</td>
                <td>{{ $book->cost }}</td>
                <td>{{ $book->created_at->format('M d, Y') }}</td>
                <td>{!! $book->ispublic ? '<i class="fa fa-check fa-xs" ></i> yes':'<i class="fa fa-times fa-xs" ></i> no'!!}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('bottom')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        $(function(){
            $('#bookstable').DataTable();
        })
    </script>
@endsection