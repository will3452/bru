@extends('layouts.master')
@section('main-content')
    <div class="d-flex justify-content-between mb-2">
        <a href="{{ route('admin.home') }}" class="btn btn-sm btn-primary">Back to Dashboard</a>
        <a href="{{ route('admin.product.add') }}" class="btn btn-primary btn-sm">Add Product</a>
    </div>
    <table id="msgtable">
        <thead>
            <tr>
                <th>
                    ID 
                </th>
                <th>
                    IMAGE
                </th>
                <th>
                    NAME
                </th>
                <th>
                    PRICE
                </th>
                <th>
                    DESCRIPTION
                </th>
                <th>
                    AVAILABLE
                </th>
                <th>
                    OPTION
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>
                        {{ $product->uid }}
                    </td>
                    <td>
                        <img src="{{ $product->picture }}" alt="" class="image">
                    </td>
                    <td>
                        {{ $product->name }}
                    </td>
                    <td>
                        {{number_format( $product->price, 2) }}
                    </td>
                    <td>
                        {!! $product->desc !!}
                    </td>
                    <td>
                        {{ $product->is_available }}
                    </td>
                    <td>
                        <p>N/a</p>
                    </td>
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
    <style>
        .image{
            width: 50px;
            height:50px;
            object-fit: contain;
            object-position: center;
        }
    </style>
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
            //  'pdf'
        ],
    });
        $('button').addClass('.btn')
        })
        
    </script>
@endsection