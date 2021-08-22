@extends('layouts.admin')
@section('main-content')
    <h1>
        REPORT
    </h1>
    <div class="card">
        <div class="card-header">
            READER STATISTIC
        </div>
        <div class="card-body">
            Age 
            @foreach ($report['ages'] as $key=>$value)
                {{ $key }} => {{ $value }} <br/>
            @endforeach
        </div>
    </div>
@endsection
