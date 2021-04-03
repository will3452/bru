@extends('layouts.admin')
@section('main-content')
    @livewire('film-create')
    <hr>
    <div class="form-group">
        <label for="">Age Restriction</label>
        <select name="age_restriction" id="" class="custom-select">
            <option value="none">None</option>
            <option value="16 and up">16 and Up</option>
            <option value="18 and up">18 and Up</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Language</label>
        <select name="language" id="" class="custom-select" required>
            <option value="english">English</option>
            <option value="filipino">Filipino</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Cover</label>
        <div>
            <input type="file" name="cover" accept="image/*" required>
        </div>
        <div class="alert alert-warning mt-2">
            <div>
                <strong>Required*</strong>
            </div>
            <input type="checkbox" required id="ck_box" name="cpy">
            @copyright_disclaimer
        </div>
    </div>
    <div class="form-group">
        <label for="">Please submit the video for approval to the Admin. </label>
        {{-- <input type="file" id="" accept="video/*" class="d-block" name="video" required> --}}
        <ul id="filelist" class="list-group mb-2"></ul>
        <div id="container">
            <a id="browse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
            <a id="start-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
        </div>
        <input type="hidden" name="video" id="video_file">
        <pre id="console" class="text-danger"></pre>
        <div class="alert alert-warning mt-2">
            <input type="checkbox" required name="cpy">
            @copyright_disclaimer
        </div>
    </div>
    <div class="form-group">
        <label for="">Type of Crystal</label>
        <select name="gem" id="" class="select2 form-control">
            <option value="White">White Crystal</option>
            <option value="Purple">Purple Crystal</option>
        </select>
    </div>
    <div class="form-group">
        <label for="">Cost</label>
        <input type="number" name="cost" class="form-control" min="0" value="0">
    </div>
    <div class="form-group">
        <button class="btn btn-block btn-primary" id="submit" disabled="true">
            Submit
        </button>
    </div>
</form>
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    @livewireStyles
@endsection

@section('bottom')
    @livewireScripts
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $(function(){
             $('.select2').select2();
        })
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
                { title : "video files", extensions : "mp4, 3gp" },
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
            title:'Video Uploaded!',
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
