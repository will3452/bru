@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Chapter') }}</h1>
    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div id="form-app">
        <form action="{{ route('books.chapters.store.novel', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="#">Title</label>
                <input type="text" class="form-control" name="title"  value="{{ old('title') }}">
            </div>
            <div class="form-group">
                <label for="#">Chapter <small><i>Last Chapter {{ $book->lastchapter }}</i></small></label>
                <input type="text" class="form-control" name="sq"  required value="{{ old('sq') ?? $book->lastchapter+1 }}">
            </div>
            <div class="form-group">
                @if(request()->richtext != true)
                    <a href="?richtext=true}"><i class="fa fa-align-center"></i> Use Text Rich Editor instead ? </a>
                @else
                    <a href="?"><i class="fa fa-align-center"></i> Use pure text editor ?</a>
                    <div class="alert alert-warning mt-2">
                        <div>
                            <strong>Required*</strong>
                        </div>
                        <input type="checkbox" required id="ck_box" name="cpy" required>
                        @copyright_disclaimer
                    </div>
                @endif
            </div>
            <div class="form-group">
                <textarea style="font-size:20px;" v-model="content" class="form-control" id="chapter_content" name="chapter_content" rows="10" placeholder="Write content here..." ></textarea>
            </div>
            <div class="form-group">
                <label for="">
                    Chapter Type
                </label>
                <select name="chapter_type" id="chapter_type" class="form-control">
                    <option value="regular">Regular</option>
                    <option value="special">Special</option>
                    <option value="premium">Premium</option>
                    <option value="premium_with">Premium w/ Free Art Scene</option>
                </select>
                <div class="form-group">
                    <label for="">Cost</label>
                    <input type="number" name="art_cost" value="{{ old('cost') ?? 0 }}" class="form-control">
                </div>
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
                    <div>
                        <label for="picture">Upload Art Scene</label>
                        <input type="file" class="d-block" name="art_photo" id="picture" accept="image/*" >
                    </div>
                    
                </div>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-block btn-primary">Create</button>
            </div>
        </form>
    </div>
       
@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection

@section('bottom')
    @if (isset(request()->first))
            <script>
            swal.fire({
            title: 'Do want to use Rich Text Editor?',
            text: `You can control the appearance of your text using the rich-text editor.`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No'
            }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '{{ url()->current() }}?richtext=true';
            }
            })
        </script>
    @endif
    <script src="{{ asset('vendor/select2/select2.min.js') }}" defer></script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
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
            const editor = CKEDITOR.replace('chapter_content', {height:"50vh", toolbarGroups: [{
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
      editor.Value = "{{ request()->content }}"
      @endif
      $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });
        })
    </script>
@endsection
