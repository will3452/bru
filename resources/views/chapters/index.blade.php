@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Chapters of '.$book->title) }}</h1>
    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    <table id="bookstable" class="table table-striped table-bordered">
        <thead>
            <tr>
                <th>
                    Chapter #
                </th>
                <th>
                    Title
                </th>
                <th>
                    Type
                </th>
                <th>
                    With Free Art Scene
                </th>
                <th>
                    Created at
                </th>
                <th>
                    Updated at
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($book->chapters as $chapter)
            <tr>
                <td>
                    {{ $chapter->sq }}
                </td>
                <td>
                    <a href="{{ route('books.chapters.show', ['book'=>$chapter->book, 'chapter'=>$chapter]) }}">
                        {{ $chapter->title }} <i class="fa fa-link fa-xs"></i>
                    </a>
                </td>
                <td>
                    {{ $chapter->type }}
                </td>
                <td>
                    {{ $chapter->art ? 'yes':'no' }}
                </td>
                <td>
                    {{ $chapter->created_at }}
                </td>
                <td>
                    {{ $chapter->updated_at }}
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
            $('#bookstable').DataTable();
        })
    </script>
@endsection