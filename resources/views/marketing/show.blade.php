@extends('layouts.admin')
@section('main-content')
    <x-card header="MARKET DETAILS">
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

    <x-card header="CONTRACT">
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
     @if ($market->status == 'draft' || $market->status == 'resubmit')
    <form action="{{ route('marketing.save', $market->id) }}" method="POST" enctype="multipart/form-data">

        @csrf

        @method('PUT')
    @endif
    @if ($market->status == 'draft' || $market->status == 'resubmit')
        <x-payment title="PAYMENT" paymentFor="Marketing" amount="{{ $market->cost }}"></x-payment>
    @else
        <x-payment-info :model="$market->invoice"/>
    @endif

        <x-card header="TIMELINE">
            <ul>
                <li>
                    Please print 5 copies of the downloaded contracts and affix your signature on EACH PAGE. Wet signature please.
                </li>
                <li>
                    Please attach hard copies of the proof of payment for each copy of the contract and sign each page. 
                </li>
                <li>
                    Send the documents to the office. Address is indicated on the contract.
                </li>
                <li>
                    Once we receive the documents, and everything is in order we are good to go!
                </li>
            </ul>
        </x-card>

        @if ($market->status == 'draft' || $market->status == 'resubmit')
           <div class="my-2">
                <x-form.group>
                    <button class="btn btn-primary btn-block">
                        Submit
                    </button>
                </x-form.group>
            </div> 
        @else 
        <div class="my-2">
            <x-form.group>
                <x-alert color="success">
                    Your form has been submitted!
                </x-alert>
            </x-form.group>
        </div>
        @endif

 @if ($market->status == 'draft' || $market->status == 'resubmit')
    </form>
 @endif

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