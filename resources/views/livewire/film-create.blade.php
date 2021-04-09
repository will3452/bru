
<div>

    <div class="form-group">
        <label for="">Category</label>
        <select wire:model="category" name="category" id="" class="custom-select">
            <option value="trailer">Trailer</option>
            <option value="film">Film</option>
            <option value="animation">Animation</option>
        </select>
    </div>
    @if($category == 'trailer' )
        <div class="form-group">
            <label for="">To which work is this trailer connected to ?</label>
            <select name="connect_id" id="" class="custom-select select2">
                <option value="">None</option>
                @foreach (\App\Book::get() as $book)
                    <option value="book-{{$book->id}}">
                        {{ $book->title }} (book)
                    </option>
                @endforeach
                @foreach (\App\Thrailer::get() as $trailer)
                    <option value="film-{{$trailer->id}}">
                        {{ $trailer->title }} (trailer/film)
                    </option>
                @endforeach
            </select>
        </div>

    @else
    <div class="form-group">
        <label for="#">Genre</label>
        <select name="genre" id="genre" class="custom-select select2">
            @php
                $first = '';
            @endphp
            @foreach(\App\Genre::get() as $genre)
                @if($loop->first)
                    @php
                        $first = $genre;
                    @endphp
                @endif
            <option value="{{ $genre->name }}">
                {{ $genre->name }}
            </option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="">Is this part of an event ?</label>
        <div>
            <label for="">
                <input type="checkbox" wire:model="partOfEvent" value="1" checked="{{$partOfEvent == 1}}"> Yes
            </label>
        </div>
    </div>
        @if($partOfEvent == 1)
            <div class="form-group">
                <label for="">Choose an event</label>
                <select name="event_id" id="" class="custom-select select2">
                    @foreach (\App\Event::get() as $event)
                        <option value="{{ $event->id }}">{{$event->name}}</option>
                    @endforeach
                </select>
            </div>
        @endif
        <div class="form-group">
            <label for="">Would you like to upload a Scene Preview for this film?</label>
            <div>
                <input type="checkbox" wire:model="hasPreview"> Yes
            </div>
        </div>
        @if ($hasPreview)
            <div class="form-group">
                {{-- <div wire:loading.remove>
                    <video  src="{{ $preview != null ? $preview->temporaryUrl() :'' }}" controls class="col-12 col-md-4"></video>
                </div> --}}
                {{-- <input type="file" accept="video/*" name="preview" required> --}}
                <ul id="xfilelist" class="list-group mb-2"></ul>
                <div id="xcontainer">
                    <a id="xbrowse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
                    <a id="xstart-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
                </div>
                <input type="hidden" name="preview" id="video_previewfile">
                <pre id="xconsole" class="text-danger"></pre>
                <div class="alert alert-warning mt-2">
                    <input type="checkbox" required>
                    @copyright_disclaimer
                </div>
            </div>
            <div class="form-group">
                <label for="">
                    Preview Cost
                </label>
                <input type="text" placeholder="White Crystal" required name="preview_cost" class="form-control form-control-sm">
            </div>
            <script>
                //uploader for preview videos

                var xuploader = new plupload.Uploader({
                    browse_button: 'xbrowse', // this can be an id of a DOM element or the DOM element itself
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

                xuploader.bind('FilesAdded', function(up, files) {
                    var html = '';
                    if(up.files.length > 1) up.files.splice(0,1);
                    plupload.each(files, function(file) {
                        html += '<li class="list-group-item" id="' + file.id + '">' + file.name + ' (' + plupload.formatSize(file.size) + ') <b></b></li>';
                    });
                    document.getElementById('xfilelist').innerHTML = html;
                    document.getElementById('xconsole').textContent = '';
                });

                xuploader.bind('UploadProgress', function(up, file) {
                    document.getElementById(file.id).getElementsByTagName('b')[0].innerHTML = `
                    <span>${file.percent}%</span>
                    <div class="progress">
                        <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" style="width: ${file.percent}%" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    `;
                    
                });
                xuploader.bind('FileUploaded',  async function(up, file, info) {
                let res = JSON.parse(info.response)
                let path = res.file_name;
                await swal.fire({
                    iconHtml:'<i class="fa fa-check fa-success"></i>',
                    title:'Preview Video Uploaded!',
                    showConfirmButton:false,
                    timer:3000
                })
                document.querySelector('.progress-bar').classList.remove('progress-bar-animated')
                // document.getElementById('submit').disabled = false;
                document.getElementById('video_previewfile').value=path;
                
                });

                xuploader.bind('Error', function(up, err) {
                    document.getElementById('xconsole').innerHTML += err.message;
                    alert(err.message)
                });

                document.getElementById('xstart-upload').onclick = function() {
                    xuploader.start();
                };
                xuploader.init();
            </script>
        @endif
    @endif
</div>
