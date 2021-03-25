@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Show Art Scene</h1>
    <a href="{{ route('arts.list') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    <img src="{{ $art->file }}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $art->title }}</h5>
                                <p class="text-capitalize">By <strong>{{ $art->artist }}</strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-heart"></i></span>
                                <span class="description">0</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-comments"></i></span>
                                <span class="description">0</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-book-reader"></i></span>
                                <span class="description">0</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class=" card shadow mb-2">
                <div class="card-body">
                    <h6 class="heading-small text-muted mb-4">Tags</h6>
                    @forelse($art->tags as $tag)
                        <a href="#" class="badge badge-primary">{{ $tag->name }}</a>
                    @empty
                    <i>No Tags Associated to this book</i>
                    @endforelse
                    {{-- @if($art->tags()->count() < 10)
                        <hr/>
                        <form action="{{ route('books.tags.store', $art) }}" method="POST">
                            @csrf
                            <label for="">Add new Tag</label>
                            <select name="tag[]" id="tag" multiple class="form-control" required>
                            </select>
                            <div class="text-warning">only the first ten will be submitted</div>
                            <button class="btn btn-primary"><i class="fa fa-plus"></i> Add tag</button>
                        </form>
                    @endif --}}
                </div>
            </div>
        </div>
        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Art Work Details</h6>
                </div>

                <div class="card-body">
                    <form action="{{ route('arts.update', $art) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="">Art Scene Title</label>
                            <input type="text" name="title" class="form-control" value="{{ old('title') ?? $art->title }}">
                        </div>
                        <div class="form-group">
                            <label for="">Art Scene Description</label>
                            <textarea name="description" id="" cols="30" rows="10" class="form-control">{{ old('description') ?? $art->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="">Artist</label>
                            <select name="artist" id="" class="form-control">
                                @foreach(auth()->user()->pens as $pen)
                                <option value="{{ $pen->name }}" {{ $art->artist == $pen->name ? 'selected':'' }}>
                                {{ $pen->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="#">Genre</label>
                            <select name="genre" id="" class="form-control">
                                @foreach(\App\Genre::get() as $genre)
                                <option value="{{ $genre->name }}" {{ $art->genre == $genre->name ? 'selected':'' }}>{{ $genre->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="#">Lead's College</label>
                            <select class="form-control" name="lead_college">
                                <option value="Integrated School" {{ $art->lead_college == 'Integrated School' ? 'selected':''}}>Integrated School</option>
                                <option value="Berkeley" {{ $art->lead_college == 'Berkeley' ? 'selected':''}}>Berkeley</option>
                                <option value="Reagan" {{ $art->lead_college == 'Reagan' ? 'selected':''}}>Reagan</option>
                            </select>
                        </div>
                        <div class="form-group" x-data="
                            {
                                isConfirmed:false,
                                isChange(){
                                    if(!this.isConfirmed) {
                                        let con = confirm('Request to change the cost of Art Scene is subject to Admin\'s approval.Would you like to proceed?')
                                        if(con){
                                            this.isConfirmed = true;
                                        }else{
                                            this.$refs.cost.value = {{ $art->cost }}
                                        }
                                    }
                                }
                            }">
                            <label for="#">Art Scene cost</label>
                            <input type="number" x-on:input="isChange()" x-ref="cost" name="cost" class="form-control" value="{{ $art->cost }}">
                        </div>
                        {{-- <h5>Upload Art</h5>
                        <div class="form-group">
                            <div class="custom-file">
                                <label class="custom-file-label" for="art">Choose from file</label>
                                <input type="file" name="file" id="art" accept="image/*" required class="custom-file-input">
                            </div>
                        </div>
                        <div class="alert alert-warning mt-2">
                            <div>
                                <strong>Required*</strong>
                            </div>
                            <input type="checkbox" id="ck_box3" name="cpy" required>
                            @copyright_disclaimer
                        </div> --}}
                        <button class="btn btn-primary btn-block">Save Changes</button>
                    </form>
                </div>

            </div>
            <div x-data="
            {
                isDelete:false,
                confirmDelete(){
                    if(!this.isDelete){
                        let con = confirm('Your request to delete your Art Scene is subject to Admin\'s approval.Would you like to proceed?');
                        if(con){
                            this.isDelete = true;
                            this.$refs.delete.click()
                        }
                    }
                }
            }">
                <button x-show="!isDelete" x-on:click="confirmDelete()" class="btn btn-danger" type="button" ><i class="fa fa-trash"></i> Delete</button>
                <button x-show="isDelete" class="btn btn-danger" type="button" data-toggle="modal" data-target="#deletemodal" x-ref="delete"><i class="fa fa-trash"></i> Delete</button>
            </div>
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
                <form action="{{ route('arts.destroy', $art) }}" method="POST" id="deleteform">
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
            CKEDITOR.replace('blurb');
            CKEDITOR.replace('credit_page');
        });
    </script>
@endsection