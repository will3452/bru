@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create an Album') }}</h1>
    <a href="{{ route('albums.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('albums.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        @livewire('album-create')
        
        <x-form.group>
            <x-form.input type="text" label="Album Title" name="title" required />
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Album Description"
            name="desc"
            required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Album Credits"
            name="credits" required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.label>Upload Album Cover</x-form.label>
            <x-form.file name="cover" label="" required/>
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>

        <x-form.group>
            <x-button type="submit" color="primary">Submit</x-button>
        </x-form.group>

    </form>
@endsection

@section('top')
    <x-vendor.ckeditor/>
@endsection

