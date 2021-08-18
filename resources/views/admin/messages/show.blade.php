@extends('layouts.master')
@section('main-content')
<div class="d-flex justify-content-between mb-2">
    <a href="{{ route('admin.home') }}" class="btn btn-sm btn-primary">Back to Dashboard</a>
    <div>
        <a href="{{ route('admin.messages.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-pen fa-sm mr-2"></i>Write</a>
        <a href="{{ route('admin.messages.index') }}?mtype=in&utype=user" class="btn btn-sm btn-primary"><i class="fas fa-inbox fa-sm mr-2"></i>Inbox</a>
    </div>
</div>
<div class="card">
    <div class="card-header d-flex justify-content-between">
        <div>
            <i class="fa fa-envelope-open mr-2"></i> 
        </div>
        <div>
            {{ $message->read_at != null ? 'Seen' : 'Not yet seen' }}
        </div>
    </div>
    <div class="card-body">
        @if ($message->sender_id == null)
            <div>
                Recipient : {{ $message->receiver->full_name }}
            </div>
        @else
            <div>
                Sender : {{ $message->sender->full_name }}
            </div>
        @endif
        
        <div>
            Subject : {{ $message->subject }}
        </div>
        <hr>
        <div>
            {!! $message->body !!}
        </div>
        <hr>
        <small class="text-secondary" style="font-size:10px">
            {{ $message->created_at}}
        </small>
    </div>
</div>
<form class="mt-2"  action="{{ route('admin.messages.destroy', $message) }}" method="POST">
    @csrf
    @method("DELETE")
    <button class="btn btn-danger btn-sm ">
        <i class="fa fa-trash fa-sm"></i>
        Delete
    </button>
    <a href="{{ route('admin.messages.create') }}?subject={{ $message->subject }}&email={{ $message->sender->id ?? '' }}" class="btn btn-primary btn-sm">
        <i class="fa fa-pen fa-sm"></i> Write Message
    </a>
</form>
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
    <script>
        $(function(){
            $('#msgtable').DataTable( {
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