@extends('layouts.master')
@section('main-content')
    @if (!request()->has('closed'))
        <h1 class="h3 mb-4 text-gray-800">{{ __('List of Tickets') }}</h1>
    @else
        <h1 class="h3 mb-4 text-gray-800">{{ __('List of Closed Tickets') }}</h1>
    @endif
    <div class="d-flex justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
        @if (!request()->has('closed'))
            <a href="{{ url()->current() }}?closed=true" class="btn btn-primary btn-sm mb-2"><i class="fa fa-list"></i> Closed Tickets</a>
        @endif
    </div>
    <table id="ticketTable" class="table">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Status
                </th>
                <th>
                    Sender
                </th>
                <th>
                    Current Work
                </th>
                <th>
                    Change(s)
                </th>
                <th>
                    Reason(s)
                </th>
                <th>
                    Submitted Date
                </th>
                @if (!request()->has('closed'))
                    <th>
                        Options
                    </th>
                @else 
                    <th>
                        Closed Date
                    </th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr @if(!in_array($ticket->status , ['approved', 'pending']) ) style="background:rgb(255, 197, 197)" @else style="background:rgb(200,220,234)"   @endif >
                    <td>
                        {{ $ticket->uniq_id }}
                    </td>
                    <td style="text-transform:capitalize;">
                        {{ $ticket->status == 'declined' ? 'disapproved' : $ticket->status}}
                        @if($ticket->status == 'declined')
                        <div x-data="{
                            showReason:false
                        }">
                            <div x-show="showReason" class="p-2">
                                {{ $ticket->admin_reason }}
                            </div>
                            <a href="#" x-on:click="showReason = !showReason">Reason</a>
                        </div>
                        @endif
                    </td>
                    <td>
                        {{ $ticket->user->full_name }}
                    </td>
                    <td>
                        <div>
                            Work Type: {{ $ticket->work_type }}
                        </div>
                        <div>
                            Title : {{ $ticket->ticketable->title ?? 'N/a'}}
                        </div>
                        <div>
                            Cost : {{ $ticket->ticketable->cost ?? 'N/a'}}
                        </div>
                    </td>
                    <td>
                        @if ($ticket->delete != null)
                            To Delete
                        @else
                            <div>
                                New Title: {{ $ticket->title }}
                            </div>
                            <div>
                                New Cost: {{ $ticket->cost }}
                            </div>
                        @endif
                    </td>
                    <td>
                        {{ $ticket->reason }}
                    </td>
                    <td>
                        {{ $ticket->created_at->format('m/d/y') }}
                    </td>
                    @if (!request()->has('closed'))
                        <td x-data="{
                            isIgnore:false, 
                            ignore(){

                            }
                        }">
                            <form  action="{{ route('admin.tickets.update', $ticket) }}" class="d-inline" method="POST">
                                @csrf
                                @method('PUT')
                                <button x-show="!isIgnore" class="btn btn-primary btn-sm">
                                    <i class="fa fa-check-circle"></i> Approve
                                </button>
                            </form>
                            <form  action="{{ route('admin.tickets.update', $ticket) }}" class="d-inline" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="hidden" name="action" value="ignore">
                                <button x-show="!isIgnore" x-on:click="isIgnore = true" class="btn btn-danger btn-sm" type="button">
                                    <i class="fa fa-times-circle"></i> Disapprove
                                </button>
                                <div x-show="isIgnore" class="mb-2">
                                    <label for="">Your Reason</label>
                                    <textarea name="admin_reason" required id="" cols="30" rows="5" class="form-control"></textarea>
                                    <button class="btn btn-warning btn-sm" >
                                        Submit
                                    </button>
                                    <button class="btn btn-secondary btn-sm" type="button" x-on:click="isIgnore = false">
                                        Cancel
                                    </button>
                                </div>
                            </form>
                            
                            <a  x-show="!isIgnore" href="{{ route('admin.messages.create') }}?email={{ $ticket->user->id }}" class="btn btn-success btn-sm">
                                <i class="fa fa-envelope"></i> Message
                            </a>
                        </td>
                    @else 
                        <td>
                            {{ $ticket->updated_at->format('m/d/y') }}
                        </td>
                    @endif
                    
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

@section('top')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
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
            $('#ticketTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf','colvis'
           'pdf'
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>

    @endsection