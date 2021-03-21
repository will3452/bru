@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Song') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" }}>
        </div>
        <div class="form-group">
            <label for="#">Genre</label>
            <select name="genre" id="genre" class="form-control">
                @foreach (\App\SongGenre::get() as $genre)
                    <option value="{{ $genre->name }}">
                        {{ $genre->name }}
                    </option>
                @endforeach
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
                                <option value="" selected>None</option>
                                @foreach (\App\Book::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Audio Books</div>
                            <select name="audio_id" id="" class="form-control">
                                <option value="" selected>None</option>
                                @foreach (\App\Audio::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Arts Scenes</div>
                            <select name="art_id" id="" class="form-control">
                                <option value="" selected>None</option>
                                @foreach (\App\Art::GETPUBLISHED() as $book)
                                    <option value="{{ $book->id }}">{{ $book->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-3">
                            <div>Films / Trailers</div>
                            <select name="thrailer_id" id="" class="form-control">
                                <option value="" selected>None</option>
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
            <input type="file" name="cover" accept="image/*" class="d-block" required>
            <div class="alert alert-warning mt-2">
                <div>
                    <strong>Required*</strong>
                </div>
                <input type="checkbox" required id="ck_box" name="cpy">
                @copyright_disclaimer
            </div>
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
            <input type="file" name="file" accept=".mp3,audio/*" class="d-block" required>
            <div class="alert alert-warning mt-2">
                <div>
                    <strong>Required*</strong>
                </div>
                <input type="checkbox" required id="ck_box" name="cpy">
                @copyright_disclaimer
            </div>
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
            <button type="submit" class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
@endsection

@section('top')
    
    {{-- <script src="{{asset('/js/app.js')}}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
@endsection