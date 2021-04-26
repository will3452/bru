@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Messages') }}</h1>
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm"><i class="fa fa-angle-left"></i> Back</a>
        <a href="{{ route('admin.messages.create') }}" class="btn btn-primary btn-sm"><i class="fa fa-pencil fa-sm"></i> Write New Message</a>
    </div>
    
    <div class="alert alert-info">
        <i class="fa fa-bell"></i> <span>Hi, {{ auth()->guard('admin')->user()->full_name }}! </span>
    </div>
    
    <table id="bookstable">
        <thead>
            <tr>
                <th>ID</th>
                <th>Subject</th>
                <th>To</th>
                <th>From</th>
                <th>Date sent</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($messages as $msg)
                <tr>
                    <td>
                        {{ $msg->id }}
                    </td>
                    <td>
                        {{ $msg->subject }}
                    </td>
                    <td>
                        @if($msg->to_id != null)
                            {{ $msg->i_receiver()->full_name }}
                        @else
                            {{ $msg->desc }}
                        @endif
                    </td>
                    <td>
                        {{ $msg->outboxable->full_name == auth()->user()->full_name ? 'You' :  $msg->outboxable->full_name}}
                    </td>
                    <td>
                        {{ $msg->created_at }}
                    </td>
                    <td>
                        
                       <a href="{{ route('admin.messages.show', $msg->id) }}" class="btn btn-primary btn-sm">View</a>
                       <form action="{{ route('admin.messages.destroy', $msg->id) }}" id="delete{{ $msg->id }}" class="d-inline" method="POST" id="deleteform{{ $msg->id }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" type="button" onclick="validatePassword('delete{{ $msg->id }}');">Delete</button>
                       </form>
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
    <script src="/js/app.js"></script>
@endsection
@section('bottom')
<script>
    function validatePassword(elId){
                let password = prompt('Enter your password');
                axios.post('{{ route('password-confirm') }}', {password})
                .then(res=>{
                    if(res.data == 1){
                        document.getElementById(elId).submit();

                    }
                })
            }
</script>
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
            'copy', 'csv', 'excel', 'pdf',
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>
@endsection