@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Book') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('books.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for=""><strong>Please select what type of book you want to create.  </strong></label>
            
            <div class="form-group">
                <select name="class" id="class_" class="select2 custom-select" required>
                    <option value="" selected disabled>----</option>
                    <option value="regular" {{ request()->type == 'regular' ? 'selected':'' }}>Regular</option>
                    <option value="premium" {{ request()->type == 'premium' ? 'selected':'' }}>Premium</option>
                    <option value="spin-off" {{ request()->type == 'spin-off' ? 'selected':'' }}>Spin-off</option>
                    <option value="event" {{ request()->has('is_event') ? 'selected':'' }}>Event</option>
                </select>
            </div>
        </div>
        @if(request()->has('is_event'))
        <div class="form-group">
            <label for="">Choose an event</label>
            <select name="event_id" id="" class="custom-select select2">
                <option value="" disabled selected>----</option>
                @foreach(\App\Event::get() as $event)
                <option value="{{ $event->id }}">
                    {{ $event->name }}
                </option>
                @endforeach
            </select>
        </div>
        @endif
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" }}>
        </div>
        <div class="form-group">
            <label for="title">Category</label>
            <select name="category" id="" class="form-control" required>
                <option value="" selected disabled>----</option>
                <option value="Novel">Novel</option>
                <option value="Illustrated Novel ">Illustrated Novel</option>
                <option value="Comic Book">Comic Book</option>
                <option value="Anthology">Anthology</option>
                <option value="Series">Series</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Book Cover</label>
            <div class="custom-file">
                <label class="custom-file-label" for="picture">Choose File</label>
                <input type="file" name="picture" id="picture" accept="image/*" required class="custom-file-input">
            </div>
        </div>
        <div class="alert alert-warning mt-2">
            <div>
                <strong>Required*</strong>
            </div>
            <input type="checkbox" required id="ck_box" name="cpy">
            @copyright_disclaimer
        </div>
        <div class="form-group">
            <label for="#">Pen Name</label>
            <select name="author" class="form-control">
                @foreach(auth()->user()->pens as $pen)
                    <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="#">Genre</label>
            <select name="genre" id="genre" class="form-control">
                @php
                    $first = '';
                @endphp
                @foreach(\App\Genre::get() as $genre)
                @if($loop->first)
                    @php
                        $first = $genre;
                    @endphp
                @endif
                <option value="{{ $genre->name }}">
                    {{ $genre->name }}
                </option>
                @endforeach
            </select>
        </div>
        @php
            $first_heat = null;
            $first_violence = null;
        @endphp
        <div class="form-group row" id="#level">
            <div class="col-md-4" id="heat_container">
                <label for="">Set Heat Level</label>
                <select name="heat" id="heat_level" class="form-control">
                    @foreach($first->heats as $heat)
                    @php
                        $heat_arr = explode('@', $heat);
                    @endphp
                    @if($loop->first)
                        @php $first_heat = end($heat_arr); @endphp
                    @endif
                    <option value="{{ $heat }}">{{ $heat_arr[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" id="violence_container">
                <label for="">Set Violence Level</label>
                <select name="violence" id="violence_level" class="form-control">
                    @foreach($first->violences as $violence)
                    @php
                        $violence_arr = explode('@', $violence);
                    @endphp
                    @if($loop->first)
                        @php $first_violence = end($violence_arr); @endphp
                    @endif
                    <option value="{{ $violence }}"> {{ $violence_arr[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" id="age_container">
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
            <div class="col-md-4" id="age_display">
                <div class="mt-2"></div>
                <strong>Age Restriction (system): </strong>
                <span id="age_count">
                    @if($first_heat != null && $first_violence != null )
                        @php 
                            $final_age = $first_heat < $first_violence ? $first_heat : $first_violence;
                            if($final_age > 0) $final_age.' and up';
                            else $final_age = 'None';
                        @endphp
                        {{ $final_age }}

                    @elseif($first_heat == null)
                        {{ $first_violence > 0 ? $first_violence.' and up' : 'None' }}
                    @elseif($first_violence == null)
                        {{ $first_heat > 0 ? $first_heat.' and up' : 'None'}}
                    @endif
                </span>
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" name="content_warning"> <strong>Please add a Content Warning to my book. </strong>
        </div>
        <div class="form-group">
            <label for="#">Tags</label>
            <select name="tag[]" id="tag" name="tag" class="form-control" multiple required></select>
            <div class="alert alert-warning d-flex align-items-center mt-2">
                <i class="fa fa-info-circle mr-2"></i>
                <div>Please list down TEN tags for your book. These tags will ensure better Search Engine Optimization (SEO) and reading recommendations based on user search and account information.</div>
            </div>
        </div>
        <div class="form-grpup">
            <label for="#">Language</label>
            <select name="language" id="" class="form-control">
                <option value="English">English</option>
                <option value="Filipino">Filipino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Lead Character</label>
            <select name="lead_character" id="" class="form-control">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="LGBTQ+">LGBTQI+</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Lead's College</label>
            <select class="form-control" name="lead_college">
                <option value="Integrated School">Integrated School</option>
                <option value="Berkeley">Berkeley</option>
                <option value="Reagan">Reagan</option>
                <option value="NON-BRU">NON-BRU</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Blurb</label>
            <textarea name="blurb" id="tetxArea" cols="30" rows="10" >{{ old('blurb') }}</textarea>
        </div>
        <div class="form-group">
            <div class="alert alert-warning d-flex align-items-center">
                <i class="fa fa-info-circle mr-2"></i>
                <span>Please note that leaving the cost of your book in 0 will allow free access to readers, so long as they have hall passes or silver tickets. Please indicate price in GEMS. </span>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Cost</label>
            <input type="number" name="cost" class="form-control" min="0" value="{{ old('cost') ?? 0 }}">
        </div>
        <div class="form-group">
            <div class="alert alert-warning d-flex align-items-center">
                <i class="fa fa-info-circle mr-2"></i>
                <span>Please type here two questions you wish to be included on the REVIEW TEMPLATE for users, who wish to review your book.</span>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">1</sup></label>
            <input type="text" class="form-control" name="review_question_1" placeholder="maximum of 300 characters only" value="{{ old('review_question_1') }}">
        </div>
        <div class="form-group">
            <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">2</sup></label>
            <input type="text" class="form-control" name="review_question_2" placeholder="maximum of 300 characters only" value="{{ old('review_question_2') }}">
        </div>
        <div class="form-group">
            <div class="alert alert-success d-flex align-items-center">
                <div class="mr-2">
                    <i class="fa fa-bell "></i> <strong>Reminder</strong>
                </div>
                <span>The Review Questions will appear as required questions the users need to answer if they wanna write a review for a specific book. </span>
            </div>
        </div>
        <div class="form-group">
            <div class="alert alert-warning d-flex align-items-center">
                <i class="fa fa-info-circle mr-2"></i>
                <span>We understand that you need to credit some of the elements of your books (like book covers) to specific people. You may write a credit page here, and it will appear at the end of your book. </span>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Credit Page</label>
            <textarea name="credit_page" rows="10">{{ old('credit_page') }}</textarea>
        </div>
        @if(request()->type == 'premium')
        <div class="form-group">
            <label for="">With Free Art Scene ?</label>
            <div>
                <input type="radio" id="yes_upload" name="ans"> Yes
            </div>
            <div>
                <input type="radio" id="no_upload" name="ans"> No
            </div>
            <div class="card card-body shadow mt-2" id="upload_art">
                <label for="">Upload art here</label>
                <input type="file" accept="image/*" class="d-block" name="free_art">

                <div class="alert alert-warning mt-2">
                    <div>
                        <strong>Required*</strong>
                    </div>
                    <input type="checkbox" required id="ck_box" name="cpy">
                    @copyright_disclaimer
                </div>
            </div>
            <div class="alert alert-info mt-2" id="no_upload_art">
                Ok, you may proceed.
            </div>
        </div>
        
        @endif
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
@endsection

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
@endsection