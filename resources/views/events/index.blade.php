@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of your events') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('home') }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Go to Dashboard</a>
        <a href="{{ route('events.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Create new event</a>
    </div>
    <table id="artstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Event Name
                </th>
                <th>
                    Event Date
                </th>
                <th>
                    Event Type
                </th>
                <th>
                    Event Crytals & Cost
                </th>
                <th>
                    Status
                </th>
                <th>
                    Action
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($events as $event)
            <tr>
                <td>
                    {{-- <a href="{{ route('events.show', $event) }}">{{ $event->name }}</a> --}}
                    {{ $event->name }}
                </td>
                <td>
                    {{ $event->date_format($event->date) }}
                </td>
                <td>
                    {{ $event->type }}
                </td>
                <td>
                    {{ $event->cost.' '.$event->gem.'(s)' }}
                </td>
                <td>
                    <div class="text-muted">
                        {{ $event->staus == null ? 'Not Approved' : 'Approved' }}
                    </div>
                </td>
                <td>
                    <button onclick="alert('under development')" class="btn btn-sm btn-danger">
                        Cancel
                    </button>
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