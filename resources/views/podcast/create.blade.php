@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Podcast') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('podcast.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Episode Title</label>
            <input type="text" class="form-control" name="title" value="{{ old('title') }}" }}>
        </div>
        <div x-data="{
            isSeries:false,
            updateisSeries(){
                let partOf = document.getElementById('part_of');
                this.isSeries = partOf.value == 'series';
            }
        }">
            <div class="form-group">
                <label for="">
                    Is this part of a series or a stand-alone episode? 
                </label>
                <select name="part_of" id="part_of" class="custom-select" x-on:change="updateisSeries()">
                    <option value="standalone">Stand-Alone</option>
                    <option value="series">Series</option>
                </select>
            </div>
            <template x-if="isSeries">
                <div>
                    <div class="form-group">
                        <label for="">Series Title</label>
                        <input type="text" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Episode Number</label>
                        <input type="number" name="episode_number" class="form-control">
                    </div>
                </div>
            </template>
        </div>
        <div class="form-group" x-data="{
            isGroup:false,
            updatecollab(){
                const tw = document.getElementById('tw');
                this.isGroup = tw.value == 'collaboration';
            }
        }">
            <label for="">Type Of Work</label>
            <select name="type_of_work" id="tw" class="custom-select" x-on:change="updatecollab()">
                <option value="solo">Solo</option>
                <option value="collaboration">Collaboration</option>
            </select>
            <template x-if="isGroup">
                <div class="form-group">
                    <label for="">Select Group</label>
                    <select name="group_id" id="group_id" class="custom-select">
                        @foreach (auth()->user()->groups as $group)
                            <option value="{{ $group->id }}">
                                {{ $group->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
            </template>
        </div>
        <div class="form-group">
            <label for="">Host</label>
            <input type="text" name="host" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="">Description</label>
            <textarea name="desc" id="" class="form-control" required></textarea>
        </div>
        <div class="form-group">
            <label for="">Upload Audio Description</label>
            <ul id="audio_filelist" class="list-group mb-2"></ul>
            <div id="audio_container">
                <a id="des_browse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
                <a id="des_start-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
            </div>
            <input type="hidden" name="audio_desc" id="audio_file" required>
            <div class="alert alert-info mt-2">
                **** NOTE that will appear on the website for the Scholar's Use: Please note that this audio description will be for the PREVIEW of the episode. 
            </div>
            <pre id="audio_console" class="text-danger"></pre>
             {{-- <input type="file" name="file" accept=".mp3,audio/*" class="d-block" required> --}}
             <div class="alert alert-warning">
                <div>
                    <strong>Required*</strong>
                </div>
                <input type="checkbox" required id="ck_box" name="cpy">
                @copyright_disclaimer
            </div>
        </div>
        <div class="form-group">
            <label for="">Credits</label>
            <textarea name="credits" required class="form-control"></textarea>
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
        <div class="form-group" x-data="
            {
                isPremium:false,
                updateispremium(){
                    const etype = document.getElementById('episode_type');
                    this.isPremium = etype.value == 'premium';
                }
            }

        ">
            <label for="">Choose Episode Type</label>
            <select name="episode_type" id="episode_type" class="custom-select" x-on:change="updateispremium()">
                <option value="regular">Regular</option>
                <option value="premium">Premium</option>
            </select>
            <template x-if="!isPremium">
                <div class="form-group mt-2">
                    <label for="">Set Number of Hall Pass required to listen.</label>
                    <input type="number" name="hall_pass" class="form-control" required>
                </div>
            </template>
            <template x-if="isPremium">
                <div class="form-group mt-2">
                    <label for="">Purple Crystal</label>
                    <input type="number" class="form-control" name="purple_crystal" required>
                </div>
            </template>
        </div>

        <div class="form-group">
            <label for="">Upload Podcast File</label>
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
            <button type="submit" class="btn btn-primary btn-block" id="submit" disabled>Submit</button>
        </div>
    </form>
@endsection

@section('top')
    
    {{-- <script src="{{asset('/js/app.js')}}"></script> --}}
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
@endsection
@section('bottom')
    
    <script>
        CKEDITOR.replace('desc');
        CKEDITOR.replace('credits');
        CKEDITOR.replace('copyright');
        CKEDITOR.replace('lyrics');
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
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
<script>
    var audio_uploader = new plupload.Uploader({
        browse_button: 'des_browse', // this can be an id of a DOM element or the DOM element itself
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

    audio_uploader.bind('FilesAdded', function(up, files) {
        var html = '';
        if(up.files.length > 1) up.files.splice(0,1);
        plupload.each(files, function(file) {
            html += '<li class="list-group-item" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
        });
        document.getElementById('audio_filelist').innerHTML = html;
        document.getElementById('audio_console').textContent = '';
    });

    audio_uploader.bind('UploadProgress', function(up, file) {
        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = `
        <span>${file.percent}%</span>
        <div class="progress">
            <div id="audio_p-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${file.percent}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        `;
        
    });
    audio_uploader.bind('FileUploaded',  async function(up, file, info) {
    let res = JSON.parse(info.response)
    let path = res.file_name;
    await swal.fire({
        iconHtml:'<i class="fa fa-check fa-success"></i>',
        title:'Podcast Audio Description Uploaded!',
        showConfirmButton:false,
        timer:3000
    })
    document.querySelector('#audio_p-bar').classList.remove('progress-bar-animated')
    document.getElementById('audio_file').value=path;
    
    });

    audio_uploader.bind('Error', function(up, err) {
        document.getElementById('audio_console').innerHTML += err.message;
        alert(err.message)
    });

    document.getElementById('des_start-upload').onclick = function() {
        audio_uploader.start();
    };
    audio_uploader.init();

</script>
@endsection