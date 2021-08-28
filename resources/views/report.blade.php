@extends('layouts.admin')
@section('main-content')
    <h1 class="text-center">
        REPORT
    </h1>
    <div>
        <x-report.pie
        title="Age"
        :labels="$report['ages']->keys()"
        :values="$report['ages']->values()"
        h="300px"
        w="300px"/>
    </div>
@endsection
