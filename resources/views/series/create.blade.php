@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create a Series') }}</h1>
    <a href="{{ route('series.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('series.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <x-form.group>
            <x-form.select 
            name="type"
            label="What type of series do you wish to create ?"
            :options="[
                [
                    'value'=>'book',
                    'label'=>'Books'
                ],
                [
                    'value'=>'audio book',
                    'label'=>'Audio Books'
                ],
                [
                    'value'=>'film',
                    'label'=>'Films'
                ],
                [
                    'value'=>'podcast',
                    'label'=>'Podcast'
                ],
            ]"
            />
        </x-form.group>

        <x-form.group>
            <x-form.select 
            default="1"
            name="type_of_work"
            label="Is this a solo series or a collaboration ? ?"
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
            />
        </x-form.group>


        <x-form.group>
            <x-form.input label="Series Title"  required name="title"/>
        </x-form.group>

        <x-form.group>
            <x-form.textarea label="Series Description" name="desc" required/>
        </x-form.group>
        
        <x-form.group>
            <x-form.textarea
            label="Series Credits"
            name="credits" required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.label>
                Upload Series Cover
            </x-form.label>
            <x-form.file name="cover" required/>
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
