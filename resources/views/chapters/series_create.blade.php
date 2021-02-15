@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Add Books') }}</h1>
    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('books.chapters.store.series', $book) }}" method="POST">
      @csrf
        <div class="form-group">
            <select name="books[]" id="books" multiple class="custom-select">
                @foreach($selection_books as $b)
                    <option value="{{ $b->id }}"><i class="fa fa-check"></i> {{ $b->title }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Add Books</button>
        </div>
    </form>
       
@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection

@section('bottom')
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        
        $(function(){
            
            $('#books').select2();
            $('#freeart').hide();

            $('#type').change(function(){
                if($(this).val() == 'premium_with'){
                    $('#freeart').show();
                }else {
                    $('#freeart').hide();
                }
            });

            @if(request()->richtext == true)
            CKEDITOR.replace('chapter_content', {height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "links",
          "groups": ["links"]
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
      ],})
      @endif
        })
    </script>
@endsection
