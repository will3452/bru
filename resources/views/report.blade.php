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
            @foreach ($report['age_report'] as $item)
                {{ $item }}
            @endforeach
        </div>
    </div>
@endsection
