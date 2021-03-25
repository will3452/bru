@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Show {{  $book->class }} book {{ $book->title }}</h1>
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <a href="{{ route('books.list') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a> 
        <a href="{{ route('books.chapters.create', $book) }}" class="btn btn-primary btn-sm"><i class="fa fa-plus-circle"></i> {{ $book->category != 'Series' ? 'Chapter':'Books' }}</a>
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
    @if($book->front == null)
        <div class="alert alert-warning d-flex">
            <i class="fa fa-exclamation-triangle mr-2"></i>
            <div>
                Please click <a href="{{ route('books.update-front', $book) }}"><strong>HERE</strong></a> to upload one .PDF file that contains your BOOK TITLE PAGE, COPYRIGHT PAGE, ACKNOWLEDGMENT PAGE AND DEDICATION PAGE. Thank you!
            </div>
        </div>
    @endif
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    <img src="{{ $book->cover }}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $book->title }}</h5>
                                <p class="text-capitalize">By <strong>{{ $book->author }}</strong></p>
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
                                <span class="heading"><i class="fa fa-book-reader"></i></span>
                                <span class="description">200</span>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
            <div class=" card shadow mb-2">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Tags</h6>
                    @forelse($book->tags as $tag)
                        <a href="#" class="badge badge-primary">{{ $tag->name }}</a>
                    @empty
                    <i>No Tags Associated to this book</i>
                    @endforelse
                    @if($book->tags()->count() < 10)
                        <hr/>
                        <form action="{{ route('books.tags.store', $book) }}" method="POST">
                            @csrf
                            <label for="">Add new Tag</label>
                            <select name="tag[]" id="tag" multiple class="form-control" required>
                            </select>
                            <div class="text-warning">Only the first ten will be submitted.</div>
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Add tag</button>
                        </form>
                    @endif
                </div>
            </div>
            @if($book->category != 'Series')
            <div class=" card shadow mb-2">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Chapters</h6>
                    <ul class="list-group mb-2">
                        @foreach($book->chapters()->limit(5)->get() as $key=>$chapter)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{  $chapter->art == null ? asset('img/noimage.png'):$chapter->art}}" alt="" class="avatar mr-2">
                                <span><strong> {{ $chapter->sq }}</strong> {{ $chapter->title }}</span>
                            </div>
                            <form action="{{ $book->category == 'Novel' ?  route('books.chapters.remove.novel',[$book, $chapter]) : route('books.chapters.remove',[$book, $chapter]) }}" method="POST">
                                @csrf
                            @method('delete')
                                <button class="btn btn-danger btn-sm"><i class="fa fa-times fa-xs"></i></button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    @if($book->chapters()->count())
                   <div class="text-center my-4">
                    <a href="{{ route('books.chapters.index', $book) }}">Browse All Chapters</a>
                   </div>
                    @endif
                    <div class="text-center">
                        <a href="{{ route('books.chapters.create', $book) }}" class="btn btn-outline-primary shadow" >
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            @else
            <div class=" card shadow mb-2">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Books</h6>
                    <ul class="list-group mb-2">
                        @foreach($book->books as $b)
                        <li class="list-group-item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center">
                                <img src="{{ $b->cover }}" alt="" class="avatar mr-2">
                                <span>{{ $b->title }}</span>
                            </div>
                            <form action="{{ route('books.chapters.remove.series',[$book, $b]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm"><i class="fa fa-times fa-xs"></i></button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                    <div class="text-center">
                        <a href="{{ route('books.chapters.create', $book) }}" class="btn btn-outline-primary shadow" >
                            <i class="fa fa-plus"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endif
            @if($book->chapters()->count())
            <a href="{{ route('books.previews.show', $book) }}" class="btn btn-block btn-primary">
                Preview Book
            </a>
            @endif
        </div>
        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Book Details</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('books.update', $book) }}" autocomplete="off" id="updateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="pl-lg-4">
                            @if($book->class == 'event')
                            <div class="form-group">
                                <label for="">
                                    Event
                                </label>
                                <input type="text" value="{{ $book->event->name }}" disabled class="form-control">
                            </div>
                            @endif
                            <div class="form-group">
                                <label for="#">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') ?? $book->title }}">
                            </div>
                            <div class="row form-group">
                                <div class="col-12 focused">
                                    <label for="title">Category</label>
                                    <select name="category" id="" class="form-control" @if(!$book->chapters()->count() && !$book->books()->count()) onchange="$('#updateForm').submit()" @else disabled @endif>
                                        <option value="Novel" {{ $book->category == 'Novel' ? 'selected':''}}>Novel</option>
                                        <option value="Illustrated Novel" {{ $book->category == 'Illustrated Novel' ? 'selected':''}}>Illustrated Novel </option>
                                        <option value="Comic Book" {{ $book->category == 'Comic Book' ? 'selected':''}} >Comic Book</option>
                                        <option value="Series" {{ $book->category == 'Series' ? 'selected':'' }}>Series</option>
                                        <option value="Anthology" {{ $book->category == 'Anthology' ? 'selected':'' }}>Anthology</option>
                                    </select>
                                </div>
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col-12 focused">
                                    <label for="#">Genre</label>
                                    <select name="genre" id="" class="form-control">
                                        <option value="Teen and Young Adult" {{ $book->genre == 'Teen and Young Adult' ? 'selected':'' }}>Teen and Young Adult</option>
                                        <option value="New Adult" {{ $book->genre == 'New Adult' ? 'selected':'' }}>New Adult</option>
                                        <option value="Romance " {{ $book->genre == 'Romance ' ? 'selected':'' }}>Romance </option>
                                        <option value="Detective and Mystery" {{ $book->genre == 'Detective and Mystery' ? 'selected':'' }}>Detective and Mystery</option>
                                        <option value="Action" {{ $book->genre == 'Action' ? 'selected':'' }}>Action</option>
                                        <option value="Historical" {{ $book->genre == 'Historical' ? 'selected':'' }}>Historical</option>
                                        <option value="LGBTQIA+" {{ $book->genre == 'LGBTQIA+' ? 'selected':'' }}>LGBTQIA+</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-grpup">
                                <label for="#">Language</label>
                                <select name="language" id="" class="form-control">
                                    <option value="English" {{ $book->language == 'English' ? 'selected':'' }}>English</option>
                                    <option value="Filipino" {{ $book->language == 'Filipino' ? 'selected':'' }}>Filipino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Lead Character</label>
                                <select name="lead_character" id="" class="form-control">
                                    <option value="Male" {{ $book->lead_character == 'Male' ? 'selected':''}}>Male</option>
                                    <option value="Female" {{ $book->lead_character == 'Female' ? 'selected':''}}>Female</option>
                                    <option value="LGBTQ+" {{ $book->lead_character == 'LGBTQ+' ? 'selected':''}}>LGBTQI+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Lead's College</label>
                                <select class="form-control" name="lead_college">
                                    <option value="Integrated School" {{ $book->lead_college == 'Integrated School' ?'selected': '' }}>Integrated School</option>
                                    <option value="Berkeley" {{ $book->lead_college == 'Berkeley' ? 'selected': '' }}>Berkeley</option>
                                    <option value="Reagan" {{ $book->lead_college == 'Reagan' ? 'selected': '' }}>Reagan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Blurb</label>
                                <textarea name="blurb" id="tetxArea" cols="30" rows="10" id="blurb">{{ old('blurb') ?? $book->blurb }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="#">Cost</label>
                                <input type="number" name="cost" class="form-control" min="0" value="{{ $book->cost }}">
                            </div>
                            <div class="form-group">
                                <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">1</sup></label>
                                <input type="text" value="{{ $book->review_question_1 }}" class="form-control" name="review_question_1">
                            </div>
                            <div class="form-group">
                                <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">2</sup></label>
                                <input type="text" value="{{ $book->review_question_2 }}" class="form-control" name="review_question_2">
                            </div>
                            <div class="form-group">
                                <label for="#">Credit Page</label>
                                <textarea name="credit_page" rows="10">{{ old('credit_page') ?? $book->credit_page }}</textarea>
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

            @if($book->class != 'event' && ($book->books()->count() != 0 || $book->chapters()->count() != 0) )
            <div class="row">
                <div class="col-md-12">
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Publish Book</h6>
                        </div>
                        <div class="card-body">
                            
                            <form class=" pl-lg-4" method="POST" action="{{ route('books.update', $book) }}">
                                @csrf
                                @method('PUT')
                                <div class="form-group">
                                    <input type="text" id="pdate" name="publish_date" required readonly class="form-control" data-field="date" value="{{ $book->publish_date }}">
                                    <div id="dbox"></div>
                                </div>
                                <div class="form-group"></div>
                                <div class="row justify-content-center">
                                    <button class="btn btn-primary">Set Publish Date</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            @if($book->books()->count() == 0 && $book->chapters()->count() == 0)
            {{-- <div class="alert alert-danger d-flex align-items-center">
                <i class="fa fa-exclamation-circle mr-2"></i>
                <div>
                You cannot delete this book if it already contains chapters.
                </div>
            </div> --}}
            <button class="btn btn-danger" type="button" data-toggle="modal" data-target="#deletemodal"><i class="fa fa-trash"></i> Delete</button>
            @else
            <div x-data="{showDeleteForm:false, makeConfirmation(){
                this.showDeleteForm = confirm('Your request to delete your Book is subject to Admin's approval.
                Would you like to proceed? ');
            }}">
            <div class="card card-body" x-show.trasition="showDeleteForm">
                <form action="{{ route('books.destroy', $book) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label for="">Enter your password:</label>
                        <input required type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Reason for the request:</label>
                        <textarea required name="reason_delete" class="form-control" id="" cols="30" rows="10"></textarea>
                    </div>
                    <div class="form-group">
                        <button class="btn btn-danger">Submit</button>
                        <button type="button" x-on:click="showDeleteForm = false" class="btn btn-secondary">Cancel</button>
                    </div>
                </form>
            </div>
                <button class="btn btn-danger" x-show="!showDeleteForm" type="button" x-on:click="makeConfirmation()"><i class="fa fa-trash" click="showDeleteForm"></i> Delete</button>
                
            </div>
            @endif
        </div>

    </div>

    <div class="modal fade" id="deletemodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel"><i class="fa fa-trash"></i></h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('books.destroy', $book) }}" method="POST" id="deleteform">
                    @csrf
                    @method('DELETE')
                    <div class="form-group">
                        <label for="">Please enter your password to continue</label>
                        <input type="password" name="password" required placeholder="*******" class="form-control">
                    </div>
                    <div class="form-group text-right">
                        <button class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
          </div>
        </div>
      </div>

@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
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