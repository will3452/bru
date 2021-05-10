@extends('layouts.admin')
@section('main-content')
    <h1 class="h3 mb-4 text-gray-800">{{ __('Create Audio Book') }}</h1>
    <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a>
    @include('partials.alert')
    
    <form action="{{ route('audio.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" name="title" id="title" value="{{ $book->title ?? '' }}">
            <div id="please-add-alert" class="text-warning"></div>
        </div>
        {{-- <div class="form-group">
            <label for="title">Category</label>
            <select name="category" id="" class="form-control">
                <option value="Novel">Novel</option>
                <option value="Illustrated Novel ">Illustrated Novel</option>
                <option value="Comic Book">Comic Book</option>
                <option value="Anthology">Anthology</option>
                <option value="Series">Series</option>
            </select>
        </div> --}}
        <div class="form-group">
            <label for="">Audio Book Cover</label>
            <div class="custom-file">
                <label class="custom-file-label" for="picture">Choose File</label>
                <input type="file" name="picture" id="picture" accept="image/*" required class="custom-file-input">
            </div>
        </div>
        <div class="alert alert-warning mt-2">
            <div>
                <strong>Required*</strong>
            </div>
            <input type="checkbox" required id="ck_box" name="cpy">
            @copyright_disclaimer
        </div>
        @if (!request()->has('autofill'))
            <div class="form-group" x-data="{
                hasEbook:false,
                isAutoFill:false,
                updateHasEbook(){
                    if(this.$refs.inputHasEbook.value =='yes'){
                        this.hasEbook = true;
                    }else {
                        this.hasEbook = false;
                    }
                },
                updateAutoFill(){
                    const title = document.getElementById('title');
                    
                    if(this.$refs.inputAutoFill.value =='yes'){
                        if(!title.value.length){
                            title.focus();
                            document.querySelector('#please-add-alert').innerText = `Input Title first.`;
                            this.$refs.inputAutoFill.value = 'no';
                            return;
                        }
                        axios.post(`{{ route('auto.fill') }}`, {title:title.value})
                        .then(res=>{
                            console.log(res.data)
                            if(res.data.length == 0){
                                swal.fire({
                                    'title':'No Ebook found!',
                                    timer:'3000'
                                });
                            }else
                            window.location.href=`{{ url()->current() }}?b=784854hfjfuyj52w6&xx=${res.data.id}&autofill=true&`
                        })
                        this.isAutoFill = true;
                    }else {
                        this.isAutoFill = false;
                    }
                }
            }">
                <p>
                    Does this Audio Book have a published ebook version on the app?
                </p>
                <select id="hasEbook" x-ref="inputHasEbook" x-on:change = "updateHasEbook()" class="custom-select">
                    <option value="no">No</option>
                    <option value="yes">Yes</option>
                </select>
                <template x-if="hasEbook">
                    <div class="card mt-2">
                        <div class="card-body">
                            <p>
                                Would you like to auto-fill the information?
                            </p>
                            <select id="isAutoFill" x-ref="inputAutoFill" x-on:change = "updateAutoFill()" class="custom-select">
                                <option value="no">No</option>
                                <option value="yes">Yes</option>
                            </select>
                            <template x-if="isAutoFill">
                                <div class=" mt-2">
                                    
                                </div>
                            </template>
                        </div>
                    </div>
                </template>
            </div>
        @endif
        <div class="form-group">
            <label for="#">Pen Name</label>
            <select name="author" class="custom-select" id="penname">
                @foreach(auth()->user()->pens as $pen)
                    <option value="{{ $pen->name }}" @if(isset($book) && $pen->name == $book->author) selected @endif>{{ $pen->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="#">Genre</label>
            <select name="genre" id="genre" class="form-control">
                @php
                    $first = '';
                @endphp
                @foreach(\App\Genre::get() as $genre)
                @if($loop->first)
                    @php
                        $first = $genre;
                    @endphp
                @endif
                <option value="{{ $genre->name }}" @if(isset($book) && $genre->name == $book->genre) selected @endif>
                    {{ $genre->name }}
                </option>
                @endforeach
            </select>
        </div>
        @php
            $first_heat = null;
            $first_violence = null;
        @endphp
        <div class="form-group row" id="#level">
            <div class="col-md-4" id="heat_container">
                <label for="">Set Heat Level</label>
                <select name="heat" id="heat_level" class="form-control">
                    @foreach($first->heats as $heat)
                    @php
                        $heat_arr = explode('@', $heat);
                    @endphp
                    @if($loop->first)
                        @php $first_heat = end($heat_arr); @endphp
                    @endif
                    <option value="{{ $heat }}"  @if(isset($book) && $heat== $book->heat_level) selected @endif>{{ $heat_arr[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" id="violence_container">
                <label for="">Set Violence Level</label>
                <select name="violence" id="violence_level" class="form-control">
                    @foreach($first->violences as $violence)
                    @php
                        $violence_arr = explode('@', $violence);
                    @endphp
                    @if($loop->first)
                        @php $first_violence = end($violence_arr); @endphp
                    @endif
                    <option value="{{ $violence }}" @if(isset($book) && $violence== $book->violence_level) selected @endif> {{ $violence_arr[0] }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4" id="age_container">
                <label for="">Set Age Restriction</label>
                <select name="age_restriction" id="age_level" class="form-control">
                    <option value="0"  @if(isset($book) && '0'== $book->age_restriction) selected @endif>
                        None
                    </option>
                    <option value="15"  @if(isset($book) && '16'== $book->age_restriction) selected @endif>
                        15 and up
                    </option>
                    <option value="18" id="_18"  @if(isset($book) && '18"'== $book->age_restriction) selected @endif>
                        18 and up
                    </option>
                </select>
            </div>
            <div class="col-md-4" id="age_display">
                <div class="mt-2"></div>
                <strong>Age Restriction (system): </strong>
                <span id="age_count">
                    @if($first_heat != null && $first_violence != null )
                        @php 
                            $final_age = $first_heat < $first_violence ? $first_heat : $first_violence;
                            if($final_age > 0) $final_age.' and up';
                            else $final_age = 'None';
                        @endphp
                        {{ $final_age }}

                    @elseif($first_heat == null)
                        {{ $first_violence > 0 ? $first_violence.' and up' : 'None' }}
                    @elseif($first_violence == null)
                        {{ $first_heat > 0 ? $first_heat.' and up' : 'None'}}
                    @endif
                </span>
            </div>
        </div>
        <div class="form-group">
            <input type="checkbox" name="content_warning"> <strong>Please add a Content Warning to my book. </strong>
        </div>
        {{-- <div class="form-group">
            <label for="#">Tags</label>
            <select name="tag[]" id="tag" name="tag" class="form-control" multiple required></select>
            <div class="alert alert-warning d-flex align-items-center mt-2">
                <i class="fa fa-info-circle mr-2"></i>
                <div>Please list down TEN tags for your book. These tags will ensure better SEO and reading recommendations based on user search and account information. </div>
            </div>
        </div> --}}
        <div class="form-grpup">
            <label for="#">Language</label>
            <select name="language" id="language" class="form-control">
                <option value="English" @if(isset($book) &&'English'== $book->language) selected @endif>English</option>
                <option value="Filipino" @if(isset($book) &&'Filipino'== $book->language) selected @endif>Filipino</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Lead Character</label>
            <select name="lead_character" id="lead_character" class="form-control">
                <option value="Male"  @if(isset($book) &&'Male'== $book->lead_character) selected @endif>Male</option>
                <option value="Female"  @if(isset($book) &&'Female'== $book->lead_character) selected @endif>Female</option>
                <option value="LGBTQA+"  @if(isset($book) &&'LGBTQA+'== $book->lead_character) selected @endif>LGBTQIA+</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Lead's College</label>
            <select class="form-control" id="lead_college" name="lead_college">
                <option value="Integrated School" @if(isset($book) &&'Integrated School'== $book->lead_college) selected @endif>Integrated School</option>
                <option value="Berkeley" @if(isset($book) &&'Berkeley'== $book->lead_college) selected @endif>Berkeley</option>
                <option value="Reagan" @if(isset($book) &&'Reagan'== $book->lead_college) selected @endif>Reagan</option>
                <option value="NON-BRU" @if(isset($book) &&'NON-BRU'== $book->lead_college) selected @endif>NON-BRU</option>
            </select>
        </div>
        <div class="form-group">
            <label for="#">Blurb</label>
            <textarea name="blurb" id="blurb" cols="30" rows="10" >
                @if(isset($book))
                    {{ $book->blurb ?? ''}}
                @else
                {{ old('blurb') ?? ''}}
                @endif
            </textarea>
        </div>
        <div class="form-group">
            <div class="alert alert-warning d-flex align-items-center">
                <i class="fa fa-info-circle mr-2"></i>
                <span>Please note that leaving the cost of your book in 0 will allow free access to readers, so long as they have hall passes or silver tickets. Please indicate price in CRYSTALS. </span>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Cost</label>
            <input type="number" name="cost" class="form-control" min="0" oninput="validate(this)" value="@if(isset($book)){{ $book->cost ?? ''}} @else{{ old('cost') ?? ''}}@endif
        ">
            <script>
                function validate(input){
                   if(input.value < 0){
                      input.value = 0;
                   }
                }
            </script>
        </div>
        <div class="form-group">
            <div class="alert alert-warning d-flex align-items-center">
                <i class="fa fa-info-circle mr-2"></i>
                <span>Please type here two questions you wish to be included on the REVIEW TEMPLATE for users, who wish to review your book.</span>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">1</sup></label>
            <input type="text" class="form-control" name="review_question_1" placeholder="maximum of 300 characters only" value="@if(isset($book)){{ $book->review_question_1 ?? ''}}@else{{ old('review_question_1') ?? ''}}@endif
            ">
        </div>
        <div class="form-group">
            <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">2</sup></label>
            <input type="text" class="form-control" name="review_question_2" placeholder="maximum of 300 characters only" value="@if(isset($book)){{ $book->review_question_2 ?? ''}}@else{{ old('review_question_2') ?? ''}}@endif
            ">
        </div>
        <div class="form-group">
            <div class="alert alert-success d-flex align-items-center">
                <div class="mr-2">
                    <i class="fa fa-bell "></i> <strong>Reminder</strong>
                </div>
                <span>The Review Questions will appear as required questions the users need to answer if they wanna write a review for a specific book. </span>
            </div>
        </div>
        <div class="form-group">
            <div class="alert alert-warning d-flex align-items-center">
                <i class="fa fa-info-circle mr-2"></i>
                <span>We understand that you need to credit some of the elements of your books (like book covers) to specific people. You may write a credit page here, and it will appear at the end of your book. </span>
            </div>
        </div>
        <div class="form-group">
            <label for="#">Credit Page</label>
            <textarea name="credit_page" id="credit_page" rows="10">
                @if(isset($book)){{ $book->credit_page ?? ''}}
                @else{{ old('credit_page') ?? ''}}
                @endif
            </textarea>
        </div>
        <div class="form-group" x-data="
        {
            viewForm:false,
            updateViewForm(){
                if(document.querySelector('#isFreeArt').value == 'yes') this.viewForm = true;
                else this.viewForm = false;
            }
        }
        ">
            <label for="">With Free Art Scene ?</label>
            <select id="isFreeArt" x-on:change="updateViewForm()" class="custom-select">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
            <template x-if="viewForm">
                <div id="art-result">
                    <div class="card card-body shadow mt-2" id="upload_art">
                        <label for="">Please upload your free Art Scene here. </label>
                        <input type="file" accept="image/*" class="d-block" name="free_art">
                        <div class="alert alert-warning mt-2">
                            <input type="checkbox" required name="">
                            @copyright_disclaimer
                        </div>
                    </div>
                    <div class="alert alert-info mt-2" id="no_upload_art">
                        Great, you may proceed.
                    </div>
                </div>
            </template>
        </div>
        <div class="form-group" x-data="
        {
            viewForm:false,
            updateViewForm(){
                if(document.querySelector('#isWork').value == 'yes') this.viewForm = true;
                else this.viewForm = false;
            }
        }">
            <label for="">Is this work in collaboration with others?</label>
            <select  id="isWork" x-on:change = "updateViewForm()" class="custom-select">
                <option value="no">No</option>
                <option value="yes">Yes</option>
            </select>
            <template x-if="viewForm">
                <div class="mt-2">
                    <label for="">Select Group.</label>
                    <select name="group_id" id="" class="custom-select">
                        @foreach (auth()->user()->groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                    <div class="alert alert-warning mt-2">
                        NOTE: If the voice actors of your audio book is not a Scholar of BRU (meaning, no BRU Account), please use the Credits section instead.
                    </div>
                </div>
            </template>
        </div>
        <div class="card card-body shadow mb-4">
            <h3>Upload Audio file</h3>
            <div class="form-group">
                <label for="">Audio file (.mp3, .wav)</label>
                {{-- <input type="file" accept="audio/*" name="audio" required class="d-block"> --}}
                <ul id="filelist" class="list-group mb-2"></ul>
                <div id="container">
                    <a id="browse" href="javascript:;" class="btn btn-sm btn-secondary"><i class="fa fa-folder fa-sm"></i> Browse</a>
                    <a id="start-upload" href="javascript:;" class="btn btn-sm btn-success"><i class="fa fa-play fa-sm"> </i> Start Upload</a>
                </div>
                <input type="hidden" name="audio" id="audio_file">
                <pre id="console" class="text-danger"></pre>
                <div class="alert alert-warning mt-2">
                    <input type="checkbox" required name="">
                    @copyright_disclaimer
                </div>
            </div>
        </div>
        <div class="form-group">
            <button type="submit" id="submit" disabled class="btn btn-primary btn-block">Submit</button>
        </div>
    </form>
@endsection

@section('top')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection
@section('bottom')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="/js/app.js"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ asset('/vendor/plupload/js/plupload.full.min.js') }}"></script>
    <script>
        var uploader = new plupload.Uploader({
                browse_button: 'browse', // this can be an id of a DOM element or the DOM element itself
                runtimes : 'html5,html4',
                url: '{{ route('audio.uploader') }}',
                chunk_size: '200kb',
                max_retries: 3,
                multi_selection:false,
                headers:{
                    'X-CSRF-TOKEN':'{{ csrf_token() }}'
                },
                max_file_size:'30mb',
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
                title:'Audio Uploaded!',
                showConfirmButton:false,
                timer:3000
            })
            document.querySelector('#p-bar').classList.remove('progress-bar-animated')
            document.getElementById('submit').disabled = false;
            document.getElementById('audio_file').value=path;
            
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
    {{-- <script src="{{ asset('vendor/select2/select2.min.js') }}"></script> --}}
    <script>
        $(function(){
            // $.fn.select2.defaults.set( "theme", "bootstrap" );
            // $('select').select2();
            // $('#tag').select2({
            //     tags:true,
            //     tokenSeparators: [',', ' ']
            // });

            $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
            });

            //rich editor
            const blurb = CKEDITOR.replace('blurb',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        }
      ],});
            const credit_page = CKEDITOR.replace('credit_page',{height:"50vh", toolbarGroups: [{
          "name": "basicstyles",
          "groups": ["basicstyles"]
        },
        {
          "name": "paragraph",
          "groups": ["list", "blocks"]
        },
        {
          "name": "links",
          "groups": ["links"]
        },
        {
          "name": "document",
          "groups": ["mode"]
        },
        {
          "name": "insert",
          "groups": ["insert"]
        },
        {
          "name": "styles",
          "groups": ["styles"]
        }
      ],});
            $('#input-radio  *').css('cursor', 'pointer');
           
            //genre logic goes here
            if(!{{ $first->age_restriction ?? 0 }}){
                $('#age_level').prop('disabled', true);
            }

            $('#genre').change(function(){

                $.post('{{ route('genre.check') }}', {genre:$('#genre').val()}, function(data, res){
                    if(res !== 'success') alert('Please check your internet connection...');
                    else {
                        console.log(data);
                        if(data.age == 'only') {
                            $('#age_level').prop('disabled', false);
                            $('#age_display').hide();
                        }else {
                            $('#age_display').show();
                            $('#age_level').prop('disabled', true);
                        }
                        $('#heat_level').html("");
                        $('#violence_level').html("");
                        $.each(data['heats'], function(index, value){
                            let arr = value.split('@');
                            $('#heat_level').append(`<option value="${value}">${arr[0]}</option>`);
                        });

                        $.each(data['violences'], function(index, value){
                            let arr = value.split('@');
                            $('#violence_level').append(`<option value="${value}">${arr[0]}</option>`);
                        });
                    }
                })
            });
            
            let heat_age = 0;
            let vio_age = 0;
            let age_str;
            $('#heat_level').change(function(){
                let val = $(this).val();
                heat_age = val.split('@')[1];
                let temp_age;
                if(heat_age > vio_age) temp_age = heat_age;
                else temp_age = vio_age;
                if(temp_age > 0) age_str = temp_age+' and up';
                else age_str = 'None';
                $('#age_count').text(age_str);
            });

            $('#violence_level').change(function(){
                let val = $(this).val();
                vio_age = val.split('@')[1];
                let temp_age;
                if(heat_age > vio_age) temp_age = heat_age;
                else temp_age = vio_age;
                if(temp_age > 0) age_str = temp_age+' and up';
                else age_str = 'None';
                $('#age_count').text(age_str);
            });
        })
    </script>
    <script>
        $(function(){
            $('#class_').change(function(){
                if($(this).val() == 'event'){
                    window.location.href = "{{ url()->current().'?is_event=true' }}";
                }else {
                    window.location.href = "{{ url()->current().'?type=' }}"+$(this).val();
                }
            })
        })
    </script>
    <script>
        @if(request()->has('xx'))

        swal.fire({
            'text':'Please double-check all data if applicable and updated. ',
            timer:5000
        });
        @endif
    </script>
@endsection