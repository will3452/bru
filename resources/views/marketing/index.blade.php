@extends('layouts.admin')
@section('main-content')
    <div class="d-flex align-items-center justify-content-between">
        <h1 class="h3 mb-4 text-gray-800">{{ __('Marketing') }}</h1>
        <a href="{{ route('marketing.create') }}" class="btn btn-primary btn-sm">Create New</a>
    </div>
    <x-card header="List">
        <table id="marketable" class="table">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>
                        Category
                    </th>
                    <td>
                        Schedule
                    </td>
                    <td>
                        Duration
                    </td>
                    <td>
                        Cost
                    </td>
                    <td>
                        Status
                    </td>
                    <td>
                        Option
                    </td>
                </tr>
            </thead>
            <tbody>
                @foreach ($markets as $market)
                    <tr>
                        <td>
                            {{ $market->unique_id }}
                        </td>
                        <td>
                            {{ $market->string_category }}
                        </td>
                        <td>
                            {{ $market->schedule }}
                        </td>
                        <td>
                            {{ $market->day_duration }}
                        </td>
                        <td>
                            {{ $market->cost }}
                        </td>
                        <td>
                            {{ $market->status }}
                        </td>
                        <td>
                            <a href="{{ route('marketing.show', $market->id) }}" class="btn btn-primary btn-sm">show</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-card>
@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('bottom')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    <script>
        $(function(){
            $('#marketable').DataTable();
        });
    </script>
@endsection