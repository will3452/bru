@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card o-hidden border-0 shadow-lg my-5 card-bg-custom">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 mb-4">{{ __('Verify Your Email Address') }}</h1>
                                </div>
                                @if (session('resent'))
                                    <div class="alert alert-success border-left-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                <br>
                                {{-- {{ __('If you did not receive the email') }} --}}
                                <form action="{{ route('verification.send') }}" method="POST" class="mt-2">
                                    @csrf
                                    <button class="btn btn-primary">{{ __('Click here to request another if you did not receive the email.') }}</button>
                                </form>
                                <div class=" mt-2">
                                    NOTE: Make sure to check your SPAM or JUNK folder before sending another request.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
