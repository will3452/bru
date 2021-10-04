@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('View PDF PAGE') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="/chapter-page/{{$page->id}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <x-form.input type="hidden" label="" name="chapter_id" value="{{$page->chapter_id}}"/>
        <x-form.group>
            <a href="{{$page->content}}" target="_blank"> View Current Page </a>
        </x-form.group>
        <x-form.group>
            Update Page
            <x-form.file name="content" label="Page Content" accept="application/pdf" />
        </x-form.group>
        <x-form.group>
            <x-button type="submit" color="primary">Submit</x-button>
        </x-form.group>
    </form>
@endsection
