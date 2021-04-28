@extends('layouts.master')
@section('main-content')
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('admin.home') }}" class="btn btn-sm btn-primary">Back to Dashboard</a>
        <div>
            <a href="{{ route('admin.messages.create') }}" class="btn btn-sm btn-primary"><i class="fa fa-pen fa-sm mr-2"></i>Write</a>
            
            @if (!isset(request()->mtype))
                <a href="{{ route('admin.messages.index') }}?utype=user&mtype=in" class="btn btn-sm btn-primary"><i class="fas fa-inbox fa-sm mr-2"></i>Inbox</a>
            @else
                <a href="{{ route('admin.messages.index') }}?utype=user" class="btn btn-sm btn-primary"><i class="fas fa-check-circle fa-sm mr-2"></i>Outbox</a>
            @endif

        </div>
    </div>
    <div class="mb-2">
        <form action="{{ url()->current() }}" method="GET" id="utypeform">
            @if(isset(request()->mtype))
                <input type="hidden" name="mtype" value="in">
            @endif
            <select name="utype" id="typeSelector" class="custom-select" onchange="$('#utypeform').submit()">
                <option value="user" @if(request()->utype == 'user') selected @endif>User</option>
                <option value="scholars" @if(request()->utype == 'scholars') selected @endif>All Scholars</option>
                <option value="students" @if(request()->utype == 'students') selected @endif>All Students</option>
                <option value="integrated school" @if(request()->utype == 'integrated school') selected @endif>All IS Students</option>
                <option value="reagan" @if(request()->utype == 'reagan') selected @endif>All Reagan Students</option>
                <option value="berkeley" @if(request()->utype == 'berkeley') selected @endif>All Berkeley Students</option>
                <option value="users" @if(request()->utype == 'users') selected @endif>All Users</option>
                <option value="vip" @if(request()->utype == 'vip') selected @endif>All VIP</option>
            </select>
        </form>
    </div>
  <form action="{{ route('admin.messages.delete.all') }}" method="POST">
    @csrf
    @if (!isset(request()->mtype))
    <table id="msgtable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>
                  Date
                </th>
                <th>
                  Recipient
                </th>
                <th>
                  Subject
                </th>
                <th>
                  Status
                </th>
                <th>
                    View
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="{{ $message->id }}">
                    </td>
                    <td>
                        {{ $message->created_at }}
                    </td>
                    <td>
                          {{ $message->receiver->full_name }}
                     </td>
                     <td>
                         {{ $message->subject }}
                     </td>
                     <td>
                         {{ $message->read_at != null ? 'Seen' : 'Not yet seen' }}
                     </td>
                     <td>
                         <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-primary btn-sm">View</a>
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <table id="msgtable" class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>
                  Date
                </th>
                <th>
                    To
                </th>
                <th>
                  Subject
                </th>
                <th>
                  Status
                </th>
                <th>
                    View
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $message)
                <tr>
                    <td>
                        <input type="checkbox" name="message_id[]" value="{{ $message->id }}">
                    </td>
                    <td>
                        {{ $message->created_at }}
                    </td>
                    <td>
                        {{ $message->sender->full_name }}
                    </td>
                     <td>
                         {{ $message->subject }}
                     </td>
                     <td>
                         {{ $message->read_at != null ? 'Seen' : 'Not yet seen' }}
                     </td>
                     <td>
                         <a href="{{ route('admin.messages.show', $message) }}" class="btn btn-primary btn-sm">View</a>
                     </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @endif
    <button class="btn btn-sm btn-danger">Delete All Selected</button>
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