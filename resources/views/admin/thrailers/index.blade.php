@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Films') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    
    <table id="artstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>
                    Title
                </th>
                <th>
                    Owner
                </th>
                <th>
                    Status
                </th>
                <th>
                    Cost
                </th>
                <th>
                    Video
                </th>
                <th>
                    Date Uploaded
                </th>
                <th>
                    Code
                </th>
                <th>
                    
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach($thrailers as $thrailer)
                <tr>
                    <td>
                        {{ $thrailer->title }}
                    </td>
                    <td>
                        {{ $thrailer->author }}
                    </td>
                    <td>
                        {{ $thrailer->approved ? 'Approved':'Pending' }}
                    </td>
                    <td>
                        {{ $thrailer->cost.' '.$thrailer->gem.' gem(s)' }}
                    </td>
                    <td>
                        <a href="{{ $thrailer->video }}" target="_blank">Click here to watch</a>
                    </td>
                    <td>
                        {{ $thrailer->created_at }}
                    </td>
                    <th>
                        {{ $thrailer->code }}
                    </th>
                    <td>
                        @if(empty($thrailer->approved))
                            <button class="btn btn-success">Approve</button>
                        @else
                            Approved
                        @endif
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
            $('#artstable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf','colvis'
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>

    @endsection