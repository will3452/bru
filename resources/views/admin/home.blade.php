@extends('layouts.master')

@section('main-content')

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Dashboard') }}</h1>

    @if (session('status'))
        <div class="alert alert-success border-left-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    
    @php
        function readableBytes($bytes) {
            $i = floor(log($bytes) / log(1024));
            $sizes = array('B', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB');

            return sprintf('%.02F', $bytes / pow(1024, $i)) * 1 . ' ' . $sizes[$i];
    }
    @endphp 

    <div class="card">
        <div class="card-header">
            Storage  
        </div>
        <div class="card-body">
            <div>
                Free {{ readableBytes(disk_free_space('/')) }} of {{ readableBytes(disk_total_space('/')) }} 
            </div>
            <div>
                <div class="progress">
                    <div class="progress-bar" role="progressbar" style="width: {{ (disk_free_space('/') / disk_total_space('/'))  }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>
        </div>
    </div>
    

@endsection
