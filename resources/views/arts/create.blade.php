@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Art Scene') }}</h1>
    <a href="{{ url()->previous() }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('arts.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <h5>Upload Art</h5>

        <x-form.group>
            <x-form.input type="text" label="Art Scene Title" name="title" required/>
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Description"
            name="desc" required>{{ old('desc') }}
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Pen Name"
            name="artist"
            :options="auth()->user()->pens->map(function($item){
                return [
                    'value'=>$item->name,
                    'label'=>$item->name
                ];
            })"/>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Genre"
            name="genre"
            :options="App\Genre::get()->map(function($item){
                return [
                    'value'=>$item->name,
                    'label'=>$item->name
                ];
            })"/>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Set Age Restriction"
            name="age_restriction"
            :options="[
                [
                    'value'=>0,
                    'label'=>'None'
                ],
                [
                    'value'=>15,
                    'label'=>'15 and up'
                ],
                [
                    'value'=>18,
                    'label'=>'18 and up'
                ]
            ]" required/>
        </x-form.group>

        <x-form.group>
            <x-form.label>Tags</x-form.label>
            <select name="tag[]" id="tag" multiple class="form-control"></select>
        </x-form.group>

        <x-form.group>
            <x-alert>
                Please list down TEN tags for your Art Scene. These tags will ensure better SEO and reading recommendations based on user search and account information. 
            </x-alert>
        </x-form.group>

       <x-form.group>
           <x-form.label>Lead's College</x-form.label>
            <select class="form-control" name="lead_college">
                <option value="Integrated School">Integrated School</option>
                <option value="Berkeley">Berkeley</option>
                <option value="Reagan">Reagan</option>
                <option value="Non-BRU">Non-BRU</option>
            </select>
       </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Credits"
            name="credits">
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.input type="number" label="Cost" name="cost" min="0" value="{{ old('cost') }}" oninput="this.value = this.value < 0 ? 0 : this.value;"/>
        </x-form.group>

        <h5>Upload Art</h5>
        <x-form.group>
            <x-form.file name="file" id="art" accept="image/*" required/>
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>
        
        <button class="btn btn-primary btn-block">Submit</button>
    </form>
@endsection

@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <x-vendor.ckeditor/>
@endsection
@section('bottom')
    <x-vendor.select2/>
    <script>
        $(function(){
            $.fn.select2.defaults.set( "theme", "bootstrap" );
            $('select').select2();
            $('#tag').select2({
                tags:true,
                tokenSeparators: [',', ' ']
            });

            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        });
    </script>
@endsection