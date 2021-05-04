@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Chapter') }}</h1>
    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    <div id="form-app">
        <form action="{{ route('books.chapters.store.novel', $book) }}" method="POST" enctype="multipart/form-data" x-data="{
            mode:'chapter',
            typeChapter:'regular',
            updateTypeChapter(){
                let ctselector = document.getElementById('chapter_type');
                this.typeChapter = ctselector.value;
            },
            updateMode(){
                this.mode = document.getElementById('mode').value;
            }
        }">
            @csrf
            
            <select name="mode" id="mode" class="form-control" x-on:change="updateMode()">
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
                    Type
                </label>
                <select name="chapter_type" x-on:change="updateTypeChapter()" id="chapter_type" class="form-control">
                    <option value="regular">Regular</option>
                    <option value="special">Special</option>
                    <option value="premium">Premium</option>
                    <option value="premium_with">Premium w/ Free Artscene</option>
                </select>
            </div>
            <template x-if="mode == 'chapter' && (typeChapter == 'premium' || typeChapter =='premium_with')">
                <div>
                    <div class="form-group">
                       <label for=""> Chapter Description </label>
                       <div class="alert alert-warning">
                        This description will appear with the prompt, confirming whether reader wishes to proceed to the Premium Chapter for a fee. Make it as enticing as possible to lure them in. 
                       </div>
                       <textarea name="desc" id="" cols="30" rows="10" class="form-control"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="">Set Age Restriction</label>
                        <select name="age_restriction" id="age_level" class="form-control">
                            <option value="0">
                                None
                            </option>
                            <option value="16">
                                16 and up
                            </option>
                            <option value="18" id="_18">
                                18 and up
                            </option>
                        </select>
                    </div>
                </div>
            </template>
            <div class="form-group">
                <label for="">Notes </label>
                <textarea name="foot_note" id="" cols="30" rows="10" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="">Cost</label>
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
                    <div>
                        <label for="picture">Upload Art Scene</label>
                        <input type="file" class="d-block" name="art_photo" id="picture" accept="image/*" >
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
    </div>
       
@endsection

@section('top')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}" defer></script>
<script>
    $(function(){
        CKEDITOR.replace('foot_note', {height:"50vh", toolbarGroups: [{
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
    })
</script>
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
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    
    <script>
        
        $(function(){
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
