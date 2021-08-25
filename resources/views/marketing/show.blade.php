@extends('layouts.admin')
@section('main-content')
    <x-card header="Market Details">
        <table class="table table-bordered">
            <tr>
                <th>
                    Event Name
                </th>
                <td>
                    <a href="{{ route('events.show', $market->event->id) }}">{{ $market->event->name }}</a>
                </td>
            </tr>
            <tr>
                <th>
                    Category
                </th>
                <td>
                    {{ $market->string_category }}
                </td>
            </tr>
            <tr>
                <th>
                    Duration
                </th>
                <td>
                    {{ $market->day_duration }} day(s)
                </td>
            </tr>
            <tr>
                <th>
                    Schedule
                </th>
                <td>
                    {{ $market->schedule }}
                </td>
            </tr>
            <tr>
                <th>
                    Cost
                </th>
                <td>
                    PHP {{ number_format($market->cost, 2) }}
                </td>
            </tr>
        </table>
    </x-card>
    <x-card header="Contract">
        <p>
            Your marketing event will be under a specific contract. 
        </p>
        <p>
            Please download the contract to review the  terms and conditions <a href="/contract.pdf" download>HERE</a>. 
        </p>
        <p>
            Please download the Annex to the contract, as you have indicated above, right <a href="{{ route('marketing.createPdf', $market->id) }}">HERE</a>. 
        </p>
    </x-card>

    <x-payment title="Marketing Payment" paymentFor="Marketing"></x-payment>
@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/datatables/dataTables.bootstrap4.min.css') }}">
@endsection
@section('bottom')
    <script src="{{ asset('vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>
    {{-- <script>
        $(function(){
            $('#marketable').DataTable();
        });
    </script> --}}
@endsection