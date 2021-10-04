@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Upload PDF PAGE') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="/chapter-page/{{$chapter_id}}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-form.input type="hidden" label="" name="chapter_id" value="{{$chapter_id}}"/>
        <x-form.group>
            Page No. {{$episode}}
        </x-form.group>
        <x-form.group>
            <x-form.file name="content" label="Page Content" accept="application/pdf" />
        </x-form.group>
        <x-form.group>
            <x-button type="submit" color="primary">Submit & Upload Another</x-button>
        </x-form.group>
    </form>
@endsection
