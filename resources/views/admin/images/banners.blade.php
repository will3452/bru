@extends('layouts.master')

@section('main-content')
    <!-- Page Heading -->
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="h3 mb-4 text-gray-800">Banners</h1>
    </div>
    <div>
        <form action="{{ route('admin.images.banner') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="">Upload Banner</label>
                <div class="input-group">
                    <input type="file" required name="image" class="form-control">
                    <div class="input-group-append">
                        <button class="btn btn-primary">
                            Add
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <table id="announcement">
        <thead>
            <tr>
                <th>
                    ID
                </th>
                <th>
                    Image Link
                </th>
                <th>
                    Date Created
                </th>
                <th>
                    Options
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($banners as $item)
                <tr>
                    <td>
                        {{ $item->id }}
                    </td>
                    <td>
                        <a href="{{ $item->image }}" target="_blank">view</a>
                    </td>
                    <td>
                        {{ $item->created_at->format('m/d/Y') }}
                    </td>
                    <td>
                        <form action="{{ route('admin.images.banner.remove', $item->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" id="a{{ $item->id }}">Remove</button>
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
    <script src="/vendor/jquery/jquery.min.js"></script>
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
            $('#announcement').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            // 'copy', 'csv', 'excel', 'pdf','colvis'
        ],
    });
        $('button').addClass('.btn')
        })
    </script>
@endsection

