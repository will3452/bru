@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Upload Chapter') }}</h1>
    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <form action="{{ route('books.chapters.store', $book) }}" method="POST" enctype="multipart/form-data" x-data="{
        mode:'chapter',
        updateMode(){
            this.mode = document.getElementById('mode').value;
        }
    }">
        @csrf
        
        <select id="mode" name="mode" class="form-control" x-on:change="updateMode()">
            <option value="chapter">Chapter</option>
            <option value="prolouge">Prologue</option>
            <option value="epilogue ">Epilogue</option>
        </select>
        <template x-if="mode == 'chapter'">
            <div>
                <div class="form-group">
                    <label for="#">Title</label>
                    <input type="text" class="form-control" name="title"  value="{{ old('title') }}">
                </div>
                <div class="form-group">
                    <label for="#">Chapter <small><i>Last Chapter {{ $book->lastchapter }}</i></small></label>
                    <input type="text" class="form-control" name="sq"  required value="{{ old('sq') ?? $book->lastchapter+1 }}">
                </div>
            </div>
        </template>
       <div class="form-group">
        <div>
            <label >Choose PDF</label>
            <input type="file" name="chapter_content" id="" accept="Application/pdf" class="d-block" required>
        </div>
       </div>
       <div class="form-group">
        <label for="">
            Type
        </label>
        <select name="chapter_type" id="chapter_type" class="form-control">
            <option value="regular">Regular</option>
            <option value="special">Special</option>
            <option value="premium">Premium</option>
            <option value="premium_with">Premium w/ Free Artscene</option>
        </select>
    </div>
    <div class="form-group">
        <label for=""> Cost</label>
        <input type="number" name="cost" value="{{ old('cost') ?? 0 }}" class="form-control">
    </div>
    <div class="form-group" id="freeart">
        <div id="freeart-child">
            <div class="alert alert-warning mt-2">
                <div>
                    <strong>Required*</strong>
                </div>
                <input type="checkbox" id="ck_box" name="cpy" required>
                @copyright_disclaimer
            </div>
            <div class="custom-file">
                <label class="custom-file-label" for="picture">Upload Art Scene</label>
                <input type="file" name="art_photo" id="picture" accept="image/*" class="custom-file-input">
            </div>
            <div class="form-group">
                <label for="">Art Scene Cost</label>
                <input type="number" name="art_cost" value="{{ old('cost') ?? 0 }}" class="form-control">
            </div>
        </div>
    </div>
        <div class="form-group">
            <button type="submit" class="btn btn-block btn-primary">Create</button>
        </div>
    </form>
       
@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection

@section('bottom')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>
    <script>
        
        $(function(){
            $('#chapter_type').select2();
            let art = $('#freeart-child').detach();

            $('#chapter_type').change(function(){
                if($(this).val() == 'premium_with'){
                    $('#freeart').append(art);
                }else {
                    $('#freeart-child').detach();
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
