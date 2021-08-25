@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Song') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('songs.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <x-form.group>
            <x-form.input type="text" label="Title" name="title"  required/>
        </x-form.group>
        
        <x-form.select
        label="Genre"
        name="genre"
        :options="\App\SongGenre::pluck('name')->map(function($value, $key){
            return [
                'value'=>$value,
                'label'=>$value
            ];
        })" required/>

        <div x-data="{
            typeOfWork:1, 
            updateWork(){
                this.typeOfWork = document.getElementById('workSelector').value;
            }
        }">

        <x-form.group>
            <x-form.select
            default="1"
            id="workSelector"
            x-on:change="updateWork()"
            label="Type of Work"
            :options="[
                [
                    'value'=>1,
                    'label'=>'Solo'
                ],
                [
                    'value'=>2,
                    'label'=>'Collaboration'
                ]
            ]"/>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Artist"
            name="artist"
            :options="
            auth()->user()->pens->map(function($item){
                    return [
                        'value'=>$item->name,
                        'label'=>$item->name
                    ];
                })
            " required/>
        </x-form.group>

        <template x-if="typeOfWork == 2">
            
            <x-form.group>
                <x-form.select
                label="Select Group"
                name="group_id"
                :options="
                    auth()->user()->groups->map(function($item){
                        return [
                            'value'=>$item->id,
                            'label'=>$item->name
                        ];
                    })
                " required/>
            </x-form.group>

        </template>
        
        </div>
        
        <x-form.group>
            <x-form.textarea
            label="Description"
            name="desc" required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Credits"
            name="credits" required>
            </x-form.textarea>
        </x-form.group>

        <div x-data="{isAssoc:false}">
            
            <x-form.group>
                <x-form.select
                x-on:change="$refs.select.value == 'yes' ? isAssoc = true:isAssoc = false"
                x-ref="select"
                default="no"
                label="Is this associated with any other works within the multiverse?"
                name=""
                :options="[
                    [
                        'value'=>'no',
                        'label'=>'No'
                    ],
                    [
                        'value'=>'yes',
                        'label'=>'Yes'
                    ],
                ]"/>
            </x-form.group>

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

        <x-form.group>
            <x-form.label>
                Cover
            </x-form.label>
            <x-form.file name="cover" required accept="image/*"/>
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>

        <x-form.group>
            <x-form.select
            label="Choose Type of Crystal"
            name="cost_type"
            :options="[
                [
                    'value'=>'purple',
                    'label'=>'Purple'
                ],
                [
                    'value'=>'white',
                    'label'=>'White'
                ],
            ]" required/>    
        </x-form.group>

         <x-form.group>
             <x-form.number label="Cost" name="cost" required/>
         </x-form.group>

        <x-form.group>
            <label for="">Upload your Song</label>
            <ul id="filelist" class="list-group mb-2"></ul>
            <div id="container">
                <a id="browse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
                <a id="start-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
            </div>
            <input type="hidden" name="file" id="video_file">
            <pre id="console" class="text-danger"></pre>
        </x-form.group>

        <x-form.group>
            <x-copyright-disclaimer/>
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Lyrics"
            name="lyrics" required>
            </x-form.textarea >
        </x-form.group>

        <x-form.group>
            <x-form.textarea
            label="Copytright"
            name="copyright" required>
            </x-form.textarea>
        </x-form.group>

        <x-form.group>
            <label for="" x-data="{shower:false}">
                <input name="is_copyright" type="checkbox" x-on:change="if(!shower){alert(`Please have it copyrighted as soon as possible. Thank you.`)}; shower = !shower;"> This song is not yet copyrighted.
            </label>
        </x-form.group>

        <x-form.group>
            <button type="submit" class="btn btn-primary btn-block" id="submit" disabled>Submit</button>
        </x-form.group>
    </form>
@endsection

@section('top')
    
    <x-vendor.ckeditor/>
    <x-alpine/>

@endsection
@section('bottom')

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