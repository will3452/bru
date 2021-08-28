@extends('layouts.admin')
@section('main-content')
    <h1 class="text-center">
        REPORT
    </h1>
    <div>

        <div class="row justify-content-between">
            <x-report.pie
            title="Ages"
            :labels="$report['ages']->keys()"
            :values="$report['ages']->values()"
            h="300px"
            w="300px"/>

            <x-report.pie
            title="Sexes"
            :labels="$report['sexes']->keys()"
            :values="$report['sexes']->values()"
            h="300px"
            w="300px"/>

             <x-report.pie
            title="Genders"
            :labels="$report['genders']->keys()"
            :values="$report['genders']->values()"
            h="300px"
            w="300px"/>

            <x-report.pie
            title="Countries"
            :labels="$report['countries']->keys()"
            :values="$report['countries']->values()"
            h="300px"
            w="300px"/>
        </div>
        
    </div>
@endsection
