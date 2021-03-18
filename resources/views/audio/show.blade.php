@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"> audio {{ $audio->title }}</h1>
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <a href="{{ route('books.list') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a> 
    </div>
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card card-body my-2">
        <audio src="{{ $audio->audio }}" controls class="w-100" controlsList="nodownload"></audio>
    </div>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    <img src="{{ $audio->cover }}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $audio->title }}</h5>
                                <p class="text-capitalize">By <strong>{{ $audio->author }}</strong></p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-heart"></i></span>
                                <span class="description">123</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-comments"></i></span>
                                <span class="description">40</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-audio-reader"></i></span>
                                <span class="description">200</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            
        </div>
        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Audio Book Details</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('audio.update', $audio) }}" autocomplete="off" id="updateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label for="#">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') ?? $audio->title }}">
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col-12 focused">
                                    <label for="#">Genre</label>
                                    <select name="genre" id="" class="form-control">
                                        <option value="Teen and Young Adult" {{ $audio->genre == 'Teen and Young Adult' ? 'selected':'' }}>Teen and Young Adult</option>
                                        <option value="New Adult" {{ $audio->genre == 'New Adult' ? 'selected':'' }}>New Adult</option>
                                        <option value="Romance " {{ $audio->genre == 'Romance ' ? 'selected':'' }}>Romance </option>
                                        <option value="Detective and Mystery" {{ $audio->genre == 'Detective and Mystery' ? 'selected':'' }}>Detective and Mystery</option>
                                        <option value="Action" {{ $audio->genre == 'Action' ? 'selected':'' }}>Action</option>
                                        <option value="Historical" {{ $audio->genre == 'Historical' ? 'selected':'' }}>Historical</option>
                                        <option value="LGBTQIA+" {{ $audio->genre == 'LGBTQIA+' ? 'selected':'' }}>LGBTQIA+</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-grpup">
                                <label for="#">Language</label>
                                <select name="language" id="" class="form-control">
                                    <option value="English" {{ $audio->language == 'English' ? 'selected':'' }}>English</option>
                                    <option value="Filipino" {{ $audio->language == 'Filipino' ? 'selected':'' }}>Filipino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Lead Character</label>
                                <select name="lead_character" id="" class="form-control">
                                    <option value="Male" {{ $audio->lead_character == 'Male' ? 'selected':''}}>Male</option>
                                    <option value="Female" {{ $audio->lead_character == 'Female' ? 'selected':''}}>Female</option>
                                    <option value="LGBTQ+" {{ $audio->lead_character == 'LGBTQ+' ? 'selected':''}}>LGBTQI+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Lead's College</label>
                                <select class="form-control" name="lead_college">
                                    <option value="Integrated School" {{ $audio->lead_college == 'Integrated School' ?'selected': '' }}>Integrated School</option>
                                    <option value="Berkeley" {{ $audio->lead_college == 'Berkeley' ? 'selected': '' }}>Berkeley</option>
                                    <option value="Reagan" {{ $audio->lead_college == 'Reagan' ? 'selected': '' }}>Reagan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Blurb</label>
                                <textarea name="blurb" id="tetxArea" cols="30" rows="10" id="blurb">{{ old('blurb') ?? $audio->blurb }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="#">Cost</label>
                                <input type="number" name="cost" class="form-control" min="0" value="{{ $audio->cost }}">
                            </div>
                            <div class="form-group">
                                <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">1</sup></label>
                                <input type="text" value="{{ $audio->review_question_1 }}" class="form-control" name="review_question_1">
                            </div>
                            <div class="form-group">
                                <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">2</sup></label>
                                <input type="text" value="{{ $audio->review_question_2 }}" class="form-control" name="review_question_2">
                            </div>
                            <div class="form-group">
                                <label for="#">Credit Page</label>
                                <textarea name="credit_page" rows="10">{{ old('credit_page') ?? $audio->credit_page }}</textarea>
                            </div>
                        </div>
                        
                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" class="btn btn-primary">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>

            </div>

            
           
        </div>

    </div>

    <div class="card card-body">
        <form action="{{ route('audio.destroy', $audio) }}" x-data="{isDelete:false}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" x-on:click="isDelete = !isDelete" x-show="!isDelete">DELETE THIS AUDIO BOOK</button>
            <div x-show="isDelete">
                <div>
                    Are you sure you want to delete this audio book? 
                </div>
                <button class="btn btn-danger" x-show="isDelete">Yes</button>
                <button type="button" class="btn btn-secondary" x-on:click="isDelete = !isDelete" x-show="isDelete">No</button>
            </div>
        </form>
    </div>
@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
    
@endsection
@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('vendor\datepicker\DateTimePicker.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}" defer></script>
    <script>
        $(function(){
            $('#dbox').DateTimePicker();
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
        })
    </script>
@endsection