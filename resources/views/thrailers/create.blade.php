@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Films') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    @livewire('film-create')
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
            max_file_size:'100mb'
        });

        uploader.bind('FilesAdded', function(up, files) {
            var html = '';
            if(up.files.length > 1) up.files.splice(0,1);
            plupload.each(files, function(file) {
                html += '<li class="list-group-item" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
            });
            document.getElementById('filelist').innerHTML = html;
        });

        uploader.bind('UploadProgress', function(up, file) {
            document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = `
            <span>${file.percent}%</span>
            <div class="progress">
                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${file.percent}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            `;
            
        });
        uploader.bind('FileUploaded',  function(up, file, info) {
        let res = JSON.parse(info.response)
        let path = res.file_name;
        document.querySelector('.progress-bar').classList.remove('progress-bar-animated')
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
