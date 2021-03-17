@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Song') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="#" method="post" enctype="multipart/form-data">
        @csrf
       
       
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" }}>
        </div>
        <div class="form-group">
            <label for="#">Genre</label>
            <select name="genre" id="genre" class="form-control">
                <option value="sample">sample 1</option>
                <option value="sample">sample 2</option>
                <option value="sample">sample 3</option>
            </select>
        </div>
        <div class="form-group" x-data="{hasOther:false}">
            <label for="">Artist</label>
            <select name="artist" id="" class="form-control">
                @foreach (\App\Pen::get() as $pen)
                    <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
            <div class="form-group mt-2">
                <input type="checkbox" x-on:change = "hasOther = !hasOther"> Include others ? 
            </div>
            <template x-if="hasOther">
                <div>
                    <textarea name="artist_others" class="form-control" placeholder="Enter others here." required></textarea>
                </div>
            </template>
        </div>
        <div class="form-group" x-data="{hasOther:false}">
            <label for="">Composer</label>
            <select name="composer" id="" class="form-control">
                @foreach (\App\Pen::get() as $pen)
                    <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
            <div class="form-group mt-2">
                <input type="checkbox" x-on:change = "hasOther = !hasOther"> Include others ? 
            </div>
            <template x-if="hasOther">
                <div>
                    <textarea name="composer_others" class="form-control" placeholder="Enter others here." required></textarea>
                </div>
            </template>
        </div>
        <div class="form-group" x-data="{hasOther:false}">
            <label for="">Lyricist</label>
            <select name="lyricist" id="" class="form-control">
                @foreach (\App\Pen::get() as $pen)
                    <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
            <div class="form-group mt-2">
                <input type="checkbox" x-on:change = "hasOther = !hasOther"> Include others ? 
            </div>
            <template x-if="hasOther">
                <div>
                    <textarea name="lyricist_others" class="form-control" placeholder="Enter others here." required></textarea>
                </div>
            </template>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="description" id="" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="">Additional Credits</label>
            <textarea name="credits" required class="form-control"></textarea>
        </div>
        <div class="form-group" x-data="{isAssoc:false}">
            <div class="form-group mt-2">
                <input type="checkbox" x-on:change = "isAssoc = !isAssoc"> Is this associated with any other works within the multiverse?
            </div>
            <template x-if="isAssoc">
                <div class="card card-body">
                    <div>
                        <input type="radio" name="associated_type" checked value="Original Sound Track"> Original Sound Track (OST)
                        <br>
                        <input type="radio" name="associated_type" value="Based On"> Based On
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-3">
                            <div>Books</div>
                            <select name="book_id" id="" class="form-control">
                                @foreach (\App\Book::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Audio Books</div>
                            <select name="audio_id" id="" class="form-control">
                                @foreach (\App\Audio::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Arts Scenes</div>
                            <select name="art_id" id="" class="form-control">
                                @foreach (\App\Art::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Films / Trailers</div>
                            <select name="thrailer_id" id="" class="form-control">
                                @foreach (\App\Thrailer::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </template>
        </div>
        <div class="form-group">
            <label for="">Cover</label>
            <input type="file" name="cover" class="d-block" required>
        </div>
        <div>
            <label for="">Choose Type Of Crystal</label>
            <select name="cost_type" id="" class="form-control">
                <option value="purple">Purple</option>
                <option value="white">White</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Cost</label>
            <input type="number" name="cost" class="form-control" min="0" value="{{ old('cost') ?? 0 }}">
        </div>
        <div class="form-group">
            <label for="">Song</label>
            <input type="file" name="file" class="d-block" required>
        </div>
        <div class="form-group">
            <label for="">Copyright</label>
            <textarea name="copyright" class="form-control" placeholder="Enter copyright details here."></textarea>
        </div>
        <div class="form-group">
            <label for="" x-data="{shower:false}">
                <input name="is_copyright" type="checkbox" x-on:change="if(!shower){alert(`Please have it copyrighted as soon as possible. Thank you.`)}; shower = !shower;"> This song is not yet copyrighted.
            </label>
        </div>
        <div class="form-group">
            <button type="button" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
@endsection

@section('top')
    
    {{-- <script src="{{asset('/js/app.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
@endsection

{{-- 
@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection
@section('bottom')
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script>
        $(function(){
            $('#upload_art').hide();
            $('#no_upload_art').hide();

            $('#yes_upload').click(function(){
                $('#upload_art').show();
                $('#no_upload_art').hide();
            })
            //
            $('#no_upload').click(function(){
                $('#no_upload_art').show();
                $('#upload_art').hide();
            })
            
        })
    </script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
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

            //rich editor
            CKEDITOR.replace('blurb',{height:"50vh", toolbarGroups: [{
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
            CKEDITOR.replace('credit_page',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "links",
          "groups": ["links"]
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
            $('#input-radio  *').css('cursor', 'pointer');
           
            //genre logic goes here
            if(!{{ $first->age_restriction ?? 0 }}){
                $('#age_level').prop('disabled', true);
            }

            $('#genre').change(function(){

                $.post('{{ route('genre.check') }}', {genre:$('#genre').val()}, function(data, res){
                    if(res !== 'success') alert('Please check your internet connection...');
                    else {
                        console.log(data);
                        if(data.age == 'only') {
                            $('#age_level').prop('disabled', false);
                            $('#age_display').hide();
                        }else {
                            $('#age_display').show();
                            $('#age_level').prop('disabled', true);
                        }
                        $('#heat_level').html("");
                        $('#violence_level').html("");
                        $.each(data['heats'], function(index, value){
                            let arr = value.split('@');
                            $('#heat_level').append(`<option value="${value}">${arr[0]}</option>`);
                        });

                        $.each(data['violences'], function(index, value){
                            let arr = value.split('@');
                            $('#violence_level').append(`<option value="${value}">${arr[0]}</option>`);
                        });
                    }
                })
            });
            
            let heat_age = 0;
            let vio_age = 0;
            let age_str;
            $('#heat_level').change(function(){
                let val = $(this).val();
                heat_age = val.split('@')[1];
                let temp_age;
                if(heat_age > vio_age) temp_age = heat_age;
                else temp_age = vio_age;
                if(temp_age > 0) age_str = temp_age+' and up';
                else age_str = 'None';
                $('#age_count').text(age_str);
            });

            $('#violence_level').change(function(){
                let val = $(this).val();
                vio_age = val.split('@')[1];
                let temp_age;
                if(heat_age > vio_age) temp_age = heat_age;
                else temp_age = vio_age;
                if(temp_age > 0) age_str = temp_age+' and up';
                else age_str = 'None';
                $('#age_count').text(age_str);
            });
        })
    </script>
    <script>
        $(function(){
            $('#class_').change(function(){
                if($(this).val() == 'event'){
                    window.location.href = "{{ url()->current().'?is_event=true' }}";
                }else {
                    window.location.href = "{{ url()->current().'?type=' }}"+$(this).val();
                }
            })
        })
    </script>
@endsection --}}