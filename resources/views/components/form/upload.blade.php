@props([
    'id'=>'upload'.\Str::random(6),
    'label'=>'',
    'chunk'=>'300kb',
    'limit'=>'800mb',
    'title'=>'audio files',
    'ext'=>'mp3, wav',
    'name'=>'file'
    
])
<label for="">{{ $label }}</label>
    <ul id="{{ $id }}filelist" class="list-group mb-2"></ul>
    <div id="{{ $id }}container">
        <a id="{{ $id }}browse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
        <a id="{{ $id }}start-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
    </div>
    <input {{ $attributes->merge([
        'type'=>'hidden',
        'name'=>$name,
        'id'=>$id.'_file'
    ]) }}/>
<pre id="{{ $id }}console" class="text-danger"></pre>
<x-error name="file"></x-error>
<script>
var {{ $id }}uploader = new plupload.Uploader({
        browse_button: '{{ $id }}browse', // this can be an id of a DOM element or the DOM element itself
        runtimes : 'html5,html4',
        url: '{{ route('video.uploader') }}',
        chunk_size: '{{ $chunk }}',
        max_retries: 3,
        multi_selection:false,
        headers:{
            'X-CSRF-TOKEN':'{{ csrf_token() }}'
        },
        max_file_size:'{{ $limit }}',
        filters: {
        mime_types : [
            { title : "{{ $title }}", extensions : "{{ $ext }}" },
        ]
        }
    });

    {{ $id }}uploader.bind('FilesAdded', function(up, files) {
        var html = '';
        if(up.files.length > 1) up.files.splice(0,1);
        plupload.each(files, function(file) {
            html += '<li class="list-group-item" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
        });
        document.getElementById('{{ $id }}filelist').innerHTML = html;
        document.getElementById('{{ $id }}console').textContent = '';
    });

    {{ $id }}uploader.bind('UploadProgress', function(up, file) {
        document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = `
        <span>${file.percent}%</span>
        <div class="progress">
            <div id="{{ $id }}p-bar" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${file.percent}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
        </div>
        `;
        
    });
    {{ $id }}uploader.bind('FileUploaded',  async function(up, file, info) {
    let res = JSON.parse(info.response)
    let path = res.file_name;
    await swal.fire({
        iconHtml:'<i class="fa fa-check fa-success"></i>',
        title:'Uploded!',
        showConfirmButton:false,
        timer:3000
    })
    document.querySelector('#{{ $id }}p-bar').classList.remove('progress-bar-animated')
    document.getElementById('{{ $id }}_file').value=path;
    
    });

    {{ $id }}uploader.bind('Error', function(up, err) {
        document.getElementById('{{ $id }}console').innerHTML += err.message;
        alert(err.message)
    });

    document.getElementById('{{ $id }}start-upload').onclick = function() {
        {{ $id }}uploader.start();
    };
    {{ $id }}uploader.init();

</script>