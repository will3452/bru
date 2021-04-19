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
        <div x-data="{
            typeOfWork:1, 
            updateWork(){
                this.typeOfWork = document.getElementById('workSelector').value;
            }
        }">
        <div class="form-group">
            <label for="">Type of Work</label>
            <select id="workSelector" x-on:change="updateWork()" class="custom-select">
                <option value="1">Solo</option>
                <option value="2">Collaboration</option>
            </select>
        </div>
        <div class="form-group">
            <label for="">Artist</label>
            <select name="artist" id="" class="form-control">
                @foreach (\App\Pen::get() as $pen)
                    <option value="{{ $pen->name }}">{{ $pen->name }}</option>
                @endforeach
            </select>
        </div>
        <template x-if="typeOfWork == 2">
            <div class="form-group">
                Select Group
                <select name="group_id" id="" class="custom-select">
                    @foreach (auth()->user()->groups as $g)
                        <option value="{{ $g->id }}">
                        {{ $g->name }}
                    </option>
                    @endforeach
                </select>
            </div>
        </template>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="desc" id="" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="">Credits</label>
            <textarea name="credits" required class="form-control"></textarea>
        </div>
        <div class="form-group" x-data="{isAssoc:false}">
            <div class="form-group mt-2">
                 Is this associated with any other works within the multiverse?
                <select name="" id="" x-ref="select" class="form-control" x-on:change = "$refs.select.value == 'yes' ? isAssoc = true:isAssoc = false" >
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
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
            <input type="number" name="cost" class="form-control" min="0" oninput="validate(this)" value="{{ old('cost') ?? 0 }}">
            <script>
                function validate(input){
                   if(input.value < 0){
                      input.value = 0;
                   }
                }
            </script>
        </div>
        <div class="form-group">
            <label for="">Song</label>
            <ul id="filelist" class="list-group mb-2"></ul>
            <div id="container">
                <a id="browse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
                <a id="start-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
            </div>
            <input type="hidden" name="file" id="video_file">
            <pre id="console" class="text-danger"></pre>
            {{-- <input type="file" name="file" accept=".mp3,audio/*" class="d-block" required> --}}
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
            <button type="submit" class="btn btn-primary btn-block" id="submit" disabled>Submit</button>
        </div>
    </form>
@endsection

@section('top')
    
    {{-- <script src="{{asset('/js/app.js')}}"></script> --}}
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
@endsection
@section('bottom')
    
    <script>
        CKEDITOR.replace('desc');
        CKEDITOR.replace('credits');
        CKEDITOR.replace('copyright');
    </script>

<script src="{{ asset('/vendor/plupload/js/plupload.full.min.js') }}"></script>
<script>
var uploader = new plupload.Uploader({
        browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
        runtimes : 'html5,html4',
        url: '{{ route('video.uploader') }}',
        chunk_size: '200kb',
        max_retries: 3,
        multi_selection:false,
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        max_file_size:'800mb',
        filters: {
        mime_types : [
            { title : "audio files", extensions : "mp3, wav" },
        ]
        }
    });

    uploader.bind('FilesAdded', function(up, files) {
        var html = '';
        if(up.files.length > 1) up.files.splice(0,1);
        plupload.each(files, function(file) {
            html += '<li class="list-group-item" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
        });
        document.getElementById('filelist').innerHTML = html;
        document.getElementById('console').textContent = '';
    });

    uploader.bind('UploadProgress', function(up, file) {
        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = `
        <span>${file.percent}%</span>
        <div class="progress">
            <div id="p-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${file.percent}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        `;
        
    });
    uploader.bind('FileUploaded',  async function(up, file, info) {
    let res = JSON.parse(info.response)
    let path = res.file_name;
    await swal.fire({
        iconHtml:'<i class="fa fa-check fa-success"></i>',
        title:'Song Uploaded!',
        showConfirmButton:false,
        timer:3000
    })
    document.querySelector('#p-bar').classList.remove('progress-bar-animated')
    document.getElementById('submit').disabled = false;
    document.getElementById('video_file').value=path;
    
    });

    uploader.bind('Error', function(up, err) {
        document.getElementById('console').innerHTML += err.message;
        alert(err.message)
    });

    document.getElementById('start-upload').onclick = function() {
        uploader.start();
    };
    uploader.init();

</script>

@endsection