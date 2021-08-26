<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">

    <!-- Favicon -->
    {{-- <link href="{{ asset('img/favicon.png') }}" rel="icon" type="image/png"> --}}
    @yield('top')
    <style>
        .bg-primary, .bg-default, .bg-gradient-primary, .btn-primary{
            background:#322F46 !important;
        }
    </style>
    <style>
        :root {
            --blue:#322F46;
        }
        .bg-primary, .bg-default, .bg-gradient-primary,.btn-primary, .btn-outline-primary:hover, .dropdown-header{
            background:#322F46 !important;
            color: white !important;
        }
        .text-primary, .btn-link {
            color: var(--blue) !important;
        }
        .border-left-primary,.btn-outline-primary {
            border-color: var(--blue) !important;
            color: var(--blue) !important;
        }
        #sidenav {
            background: url('{{ asset('img/sidenav-bg.png') }}') !important;
            background-position:center !important;
            background-size:cover !important;
        }
        .card-bg-custom {
            background: url('{{ asset('img/card-bg-custom.png') }}') !important;
            background-position:center !important;
            background-size:cover !important;
        }
        .card-bg-custom  p {
            color: white !important;
            border-color:white !important;
        }
        .card-bg-custom input{
            color: black !important;
        }
        .select2-results__option {
            color: #000 !important;
        }
        .modal-bg-custom{
            background: url('{{ asset('img/modal-bg-custom.png') }}') !important;
            background-position:center !important;
            background-size:cover !important;
        }
        .modal-bg-custom  * {
            color: white !important;
            border-color:white !important;
        }
        .icon {
            max-width: 40px !important;
        }
        .icon-xl {
            max-width: 60px !important;
        }
    </style>
    <link rel="stylesheet" href="/css/static.generic.css">
    <link rel="stylesheet" href="/css/about.css">
</head>
<body style="background:#030F4A !important;">
    @include('partials.loader')
@yield('main-content')

<!-- Scripts -->
<x-vendor.jquery/>
<script src="{{ asset('vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('js/sb-admin-2.min.js') }}"></script>
@yield('bottom')
<script>
    window.onload = function(){
        $('.loader-container').fadeOut(1000);
    }
</script>
</body>
</html>
