@extends('layouts.welcome')

@section('content')
<div>
    {!! \App\About::find(1)->content !!}
</div>
<div class="flex flex-wrap w-full my-12">
    <div class="w-full md:w-1/4">
        <div class="w-full bg-white-100 rounded-lg text-yellow-900">
            <div class="flex justify-center">
                <img src="/img/emptyuserimage.png" alt="" class="block w-32 h-32 rounded-full mt-8 object-cover">
            </div>
            <div class="text-center">
                <h2 class="text-2xl font-bold">Khiara Laurea</h2>
                <div class="text-sm text-gray-600">
                    Founder And Creator
                </div>
            </div>
        </div>
        <div class="flex justify-center text-yellow-900 ">
            <a href="#" class="hover:text-gray-600 text-2xl"><i class="fa fa-facebook-square mx-1"></i></a>
            <a href="#" class="hover:text-gray-600 text-2xl"><i class="fa fa-instagram mx-1"></i></a>
        </div>
    </div>
</div>
@endsection