@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $song->title }}</h1>
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <a href="{{ route('books.list') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back To My Works</a> 
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
        <audio src="{{ $song->file }}" controls class="w-100" controlsList="nodownload"></audio>
    </div>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    <img src="{{ $song->cover }}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $song->title }}</h5>
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
            
        </div>
        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Songs Details</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('songs.update', $song) }}" autocomplete="off" id="updateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="pl-lg-4">

                            <div class="form-group">
                                <label for="#">Title</label>
                                <input type="text" name="title" class="form-control" value="{{ old('title') ?? $song->title }}">
                            </div>
                            <div class="form-group">
                                <label for="#">Artist</label>
                                <select name="artist" id="" class="form-control">
                                    @foreach (\App\Pen::get() as $pen)
                                        <option value="{{ $pen->name }}" {{ $pen->name ==  $song->artist ? 'selected':'' }}>{{ $pen->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Other Artist</label>
                                <textarea name="artist_others" class="form-control">{{ $song->artist_others }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="#">Composer</label>
                                <select name="composer" id="" class="form-control">
                                    @foreach (\App\Pen::get() as $pen)
                                        <option value="{{ $pen->name }}" {{ $pen->name ==  $song->composer ? 'selected':'' }}>{{ $pen->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Other Composer</label>
                                <textarea name="composer_others" class="form-control">{{ $song->composer_others }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="#">Lyricist</label>
                                <select name="lyricist" id="" class="form-control">
                                    @foreach (\App\Pen::get() as $pen)
                                        <option value="{{ $pen->name }}" {{ $pen->name ==  $song->lyricist ? 'selected':'' }}>{{ $pen->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Other Lyricist</label>
                                <textarea name="lyricist_others" class="form-control">{{ $song->lyricist_others }}</textarea>
                            </div>
                            
                            <div class="form-group">
                                <label for="#">Description</label>
                                <textarea name="description" class="form-control" >{{ old('description') ?? $song->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Genre</label>
                                <select name="genre" id="">
                                    <option value="sample 1">sample </option>
                                    <option value="sample 1">sample </option>
                                    <option value="sample 1">sample </option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="#">Cost Type</label>
                                <select name="cost_type" class="form-control" id="">
                                    <option value="purple">Purple</option>
                                    <option value="white" {{ $song->cost_type == 'white' ? 'selected':''}}>White</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="#">Cost</label>
                                <input type="number" name="cost" class="form-control" min="0" value="{{ $song->cost }}">
                            </div>
                        
                            <div class="form-group" x-data="{isAssoc:{{ $song->associated_type != null ? 'true':'false' }}}">
                                <div class="form-group mt-2">
                                    <input type="checkbox" {{ $song->associated_type != null ? 'checked':'' }} x-on:change = "isAssoc = !isAssoc"> Is this associated with any other works within the multiverse?
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
                                                    <option value="" selected>None</option>
                                                    @foreach (\App\Book::GETPUBLISHED() as $book)
                                                        <option value="{{ $book->id }}" {{ $song->book_id == $book->id ? 'selected':''}}>{{ $book->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div>Audio Books</div>
                                                <select name="audio_id" id="" class="form-control">
                                                    <option value="" selected>None</option>
                                                    @foreach (\App\Audio::GETPUBLISHED() as $book)
                                                        <option value="{{ $book->id }}" {{ $song->audio_id == $book->id ? 'selected':''}}>{{ $book->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div>Arts Scenes</div>
                                                <select name="art_id" id="" class="form-control">
                                                    <option value="" selected>None</option>
                                                    @foreach (\App\Art::GETPUBLISHED() as $book)
                                                        <option value="{{ $book->id }}" {{ $song->art_id == $book->id ? 'selected':''}}>{{ $book->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="col-md-3">
                                                <div>Films / Trailers</div>
                                                <select name="thrailer_id" id="" class="form-control">
                                                    <option value="" selected>None</option>
                                                    @foreach (\App\Thrailer::GETPUBLISHED() as $book)
                                                        <option value="{{ $book->id }}" {{ $song->thrailer_id == $book->id ? 'selected':''}}>{{ $book->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </template>
                                <template x-if="!isAssoc">
                                    <div>
                                        <input type="hidden" name="book_id" value="">
                                        <input type="hidden" name="art_id" value="">
                                        <input type="hidden" name="audio_id" value="">
                                        <input type="hidden" name="thrailer_id" value="">
                                    </div>
                                </template>
                            </div>

                            <div class="form-group">
                                <label for="#">Credits </label>
                                <textarea name="credits" class="form-control">{{ old('credits') ?? $song->credits }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="">Copyright</label>
                                <textarea name="copyright" class="form-control" placeholder="Enter copyright details here.">{{ $song->copyright }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">
                                    <input name="is_copyright" type="checkbox"  {{ $song->is_copyright != null ? 'checked':''}}> This song is not yet copyrighted.
                                </label>
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
        <form action="{{ route('songs.destroy', $song) }}" x-data="{isDelete:false}" method="POST">
            @csrf
            @method('DELETE')
            <button type="button" class="btn btn-danger" x-on:click="isDelete = !isDelete" x-show="!isDelete">DELETE THIS SONG</button>
            <div x-show="isDelete">
                <div>
                    Are you sure you want to delete this song? 
                </div>
                <button class="btn btn-danger" x-show="isDelete">Yes</button>
                <button type="button" class="btn btn-secondary" x-on:click="isDelete = !isDelete" x-show="isDelete">No</button>
            </div>
        </form>
    </div>
@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
@endsection
@section('bottom')
    <script src="{{ asset('vendor/select2/select2.min.js') }}" defer></script>
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

        })
    </script>
@endsection