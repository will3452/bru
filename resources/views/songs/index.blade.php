@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Songs') }}</h1>
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
                    Genre
                </th>
                <th>
                    Artist
                </th>
                <th>
                    Composer
                </th>
                <th>
                    Lyricist
                </th>
                <th>
                    cost
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($songs as $song)
            <tr>
                <td class="d-flex justify-content-center"><img src="{{ $song->cover}}" style="object-fit:cover;"  class="avatar font-weight-bold d-block" alt=""></td>
                <td>
                    <a href="#">{{ $song->title }} <i class="fa fa-link fa-xs"></i></a>
                </td>
                <td>{{  $song->genre }}</td>
                <td>{{  $song->artist }} @if($song->artist_others) - {{ $song->artist_others }} @endif</td>
                <td>{{ $song->composer }} @if($song->composer_others) - {{ $song->composer_others }} @endif</td>
                <td>{{ $song->lyricist }} @if($song->lyricist_others) - {{ $song->lyricist_others }} @endif</td>
                <td>{{ $song->cost }}  {{ $song->cost_type }}</td>
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