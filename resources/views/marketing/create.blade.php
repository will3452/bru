@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Marketing') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    @livewire('marketing-create')
    
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
   
@endsection
@section('bottom')
    
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    
    <script>
        $(function(){
            $('#class_').change(function(){
                if($(this).val() == 'event'){
                    window.location.href = "{{ url()->current().'?is_event=true' }}";
                }else {
                    window.location.href = "{{ url()->current().'?type=' }}"+$(this).val();
                }
            })
        })
    </script>
@endsection