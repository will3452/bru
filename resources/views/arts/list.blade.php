@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of arts') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    <table id="artstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Date Uploaded
                </th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($arts as $key=>$art)
            <tr>
                <td>
                    <a href="{{ route('arts.show', $art) }}">{{ $art->title }} <i class="fa fa-link fa-xs"></i></a>
                </td>
                <td>{{ $art->cost }}</td>
                <td>{{ $art->created_at->format('M d, Y') }}</td>
                <td>
                    <a href="{{ $art->file }}" class="btn btn-primary" target="_blank">View art scene</a>
                </td>
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
            $('#artstable').DataTable();
        })
    </script>
@endsection