@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create a Collection') }}</h1>
    <a href="{{ route('collections.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('collections.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <x-form.group>
            <x-form.select
            label="Is this a solo collection or a collaboration?"
            :options="[
                [
                    'value'=>'solo',
                    'label'=>'Solo'
                ],
                [
                    'value'=>'collaboration',
                    'label'=>'Collaboration'
                ],
            ]"
            name="type_of_work" 
            />
        </x-form.group>

        <x-form.group>
            <x-form.input label="Collection Title" type="text" required name="title"/>
        </x-form.group>

        <x-form.group>
           <x-form.textarea label="Collection Description" name="desc" required></x-form.textarea>
        </x-form.group>

        <x-form.group>
           <x-form.textarea label="Collection Credits" name="credits" required></x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.label>
               Upload Collection Cover
            </x-form.label>
            <x-form.file name="cover" accept="image/*" required/>
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>

        <div class="form-group">
            <button class="btn btn-primary btn-block">
                Submit
            </button>
        </div>
        
    </form>
@endsection

@section('top')
    <x-vendor.ckeditor/>
@endsection
