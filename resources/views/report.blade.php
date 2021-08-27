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
        <x-report.pie
        title="Age"
        :labels="$report['ages']->keys()"
        :values="$report['ages']->values()"
        h="300px"
        w="300px"/>
    </div>
@endsection
