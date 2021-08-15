@extends('layouts.master')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('List of Admin') }}</h1>
    <div class="d-flex mb-2 align-items-center justify-content-between">
        <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm "><i class="fa fa-angle-left"></i> Back</a>
        <a href="{{ route('admin.admins.create') }}" class="btn btn-primary btn-sm">Add new admin</a>
    </div>
    <table id="bookstable" class="table table-stripped table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Roles</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($admins as $admin)
                <tr>
                    <td>
                        {{ $admin->full_name }}
                    </td>
                    <td>
                        {{ $admin->email }}
                    </td>
                    <td>
                        {{ implode(', ', $admin->roles()->pluck('name')->toArray()) }}
                    </td>
                    <th clas="text-center">
                        <form action="{{ route('admin.admins.destroy', $admin) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('admin.admins.show', $admin) }}" class="btn btn-sm btn-secondary">View & Update</a>
                            <button class="btn btn-danger btn-sm" onclick="deleteForm()">
                                Remove
                            </button>
                        </form>
                    </th>
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
        function deleteForm(e){
            confirm('Are you sure you want to remove this account?') && e.target.parentElement.submit();
        }
        $(function(){
            $('#bookstable').DataTable( {
            dom: 'Bfrtip',
            buttons: [
                // 'copy', 'csv', 'excel', 'pdf','colvis'
                'excel', 'pdf'
            ],
        });

        $('button').addClass('.btn');

        });
    </script>
@endsection