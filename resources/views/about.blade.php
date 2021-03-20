@extends('layouts.welcome')
@section('art', \App\About::find(1)->art)
@section('content')
<div>
    {!! \App\About::find(1)->content !!}
</div>
<div class="flex flex-wrap w-full my-12">
    @foreach (\App\AboutAccount::get() as $about)
        <div class="w-full md:w-1/4">
            <div class="w-full bg-white-100 rounded-lg text-yellow-900">
                <div class="flex justify-center">
                    <img src="{{ $about->picture }}" alt="" class="block w-32 h-32 rounded-full mt-8 object-cover">
                </div>
                <div class="text-center">
                    <h2 class="text-2xl font-bold">{{ $about->name }}</h2>
                    <div class="text-sm text-gray-600">
                        {{ $about->title }}
                    </div>
                </div>
            </div>
            <div class="flex justify-center text-yellow-900 ">
                <a href="{{ $about->fb_link }}" class="hover:text-gray-600 text-2xl"><i class="fa fa-facebook-square mx-1"></i></a>
                <a href="{{ $about->ig_link }}" class="hover:text-gray-600 text-2xl"><i class="fa fa-instagram mx-1"></i></a>
            </div>
        </div>
    @endforeach
</div>
@endsection