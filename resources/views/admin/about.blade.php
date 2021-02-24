@extends('layouts.master')
@section('main-content')
    <h1>Setting up About Page</h1>
    @livewire('about-page')
@endsection

@section('top')
    @livewireStyles
@endsection


@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace('text',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        }
      ],});
    </script>
    @livewireScripts
@endsection