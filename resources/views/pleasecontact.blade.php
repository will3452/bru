@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body">
                    <i class="fa fa-info-circle"></i> {{ $msg }}
                    <div class="mt-2 text-center">
                        <a href="/" class="btn btn-primary"><i class="fa fa-arrow-left"></i> Go back to HOME page.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
