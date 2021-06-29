@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Events') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-plus fa-sm"></i> Create new event</a>
    </div>
    <div class="card shadow mb-2">
        <div class="card-header">
            <i class="fa fa-calendar"></i> Set Day Away
        </div>
        <div class="card-body">
            <form action="{{ route('admin.event_set_day_away') }}" method="POST">
                @csrf
                @method('PUT')
                <div class="input-group">
                    <input type="text" class="form-control" value="{{ $dayAway }}" name="event_day_away" placeholder="number of days">
                    <div class="input-group-append">
                        <button class="btn btn-primary " type="submit">Set</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="alert alert-info">
        <i class="fa fa-bell"></i> <span>Hi, {{ auth()->guard('admin')->user()->full_name }}! This list shows all events created by scholars, whether approved or not. For monitoring purposes. </span>
    </div>
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Event Name
                </th>
                <th>
                    Event Host
                </th>
                <th>
                    Event Date
                </th>
                <th>
                    Event Type
                </th>
                <th>
                    Event Crystal & Cost
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
                    <a href="{{ route('admin.events.show',  $event) }}">{{ $event->name }}</a>
                </td>
                <td>
                    {{ $event->eventable->full_name }}
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
                        {{ $event->remark }}
                    </div>
                </td>
                <td>
                    <form id="cancel{{ $event->id }}" action="{{ route('admin.events.update', $event) }}" method="POST">
                        <input type="hidden" name="q" value="cancelled">
                        @csrf
                        @method('PUT')
                    </form>
                    <form id="approve{{ $event->id }}" action="{{ route('admin.events.update', $event) }}" method="POST">
                        <input type="hidden" name="q" value="approved">
                        @csrf
                        @method('PUT')
                    </form>
                    <button onclick="toApprove({{ $event->id }})" class="btn btn-sm btn-success">
                        Approve
                    </button>
                    <button onclick="toCancel({{ $event->id }})" class="btn btn-sm btn-danger">
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
    <script>
        function toCancel(id){
            confirm('are you sure, you want to cancel the event?') ? $('#cancel'+id).submit() : alert('ok');
        }
        function toApprove(id){
            confirm('are you sure, you want to approve the event?') ? $('#approve'+id).submit() : alert('ok');
        }
    </script>
@endsection