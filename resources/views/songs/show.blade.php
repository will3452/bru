@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $song->title }}</h1>
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <a href="{{ route('songs.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back to My Works</a> 
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
                                <span class="heading"><i class="fa fa-hesong"></i></span>
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
                                <input type="text" class="form-control" value="{{ old('title') ?? $song->title }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="#">Artist</label>
                                <select name="songist" id="" class="form-control">
                                    @foreach (\App\Pen::get() as $pen)
                                        <option value="{{ $pen->name }}" {{ $pen->name ==  $song->songist ? 'selected':'' }}>{{ $pen->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="#">Description</label>
                                <textarea name="desc" class="form-control" >{{ old('description') ?? $song->description }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="">Genre</label>
                                <select name="genre" id="" class="custom-select">
                                    @foreach (\App\SongGenre::get() as $genre)
                                        <option value="{{ $genre->name }}" {{ $song->genre == $genre->name ? 'selected':'' }}>
                                            {{ $genre->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="#">Type of Crystal</label>
                                <select name="cost_type" class="form-control" id="" disabled>
                                    <option value="purple">Purple</option>
                                    <option value="white" {{ $song->cost_type == 'white' ? 'selected':''}}>White</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="#">Cost</label>
                                <input type="number" disabled class="form-control" min="0" value="{{ $song->cost }}">
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
                                                <select name="song_id" id="" class="form-control">
                                                    <option value="" selected>None</option>
                                                    @foreach (\App\Art::GETPUBLISHED() as $book)
                                                        <option value="{{ $book->id }}" {{ $song->song_id == $book->id ? 'selected':''}}>{{ $book->title }}</option>
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
                                        <input type="hidden" name="song_id" value="">
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
                                <label for="">Lyrics</label>
                                <textarea name="lyrics" id="" class="form-control" required>{{ $song->lyrics }}</textarea>
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
    <div x-data="{
        showDeleteForm:false,
        makeConfirmation(){
            swal.fire({
            text: `Your request to delete your Song is subject to Admin's approval. Would you like to proceed?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes',
            cancelButtonText: 'No',
            }).then((result) => {
            if (result.isConfirmed) {
                this.deleteForm();
            }
            })
        },
        async deleteForm(){
            const { value: formValues } = await swal.fire({
                title: 'Send Ticket',
                html:
                  `
                  <div class='alert alert-warning ' style='font-size:11px;text-align:left;'>
                    You are now requesting to delete your Song. Please fill out the necessary fields and provide a brief explanation for the request. 
                    <br><br>
                    However, please be reminded that your Song is under contract. Please confirm with BRUMULTIVERSE personally after submitting the request. 
                  </div>
                  <input id='password' type='password' placeholder='Enter your password here.' class='swal2-input'>
                  <textarea id='reason' placeholder='Enter your reason' class='swal2-textarea' row='5' required></textarea>`,
                focusConfirm: false,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText:'Submit',
                preConfirm: () => {
                  return [
                    document.getElementById('password').value,
                    document.getElementById('reason').value
                  ]
                }
              })
              {{-- JSON.stringify(formValues) --}}
              if (formValues) {
                axios.post('{{ route('tickets.song.delete', $song) }}', {password:formValues[0], reason:formValues[1]})
                .then(res=>{
                    if(res.data == 1){
                        swal.fire({
                            iconHtml:`<i class='fa fa-check text-success'></i>`,
                            title: 'Your Ticket has been sent!',
                            showConfirmButton: false,
                            timer: 1500
                          })
                    }else if(res.data == 2){
                        swal.fire({
                            iconHtml:`<i class='fa fa-times text-danger'></i>`,
                            title: 'Your Password is wrong!',
                            showConfirmButton: false,
                            timer: 3000
                          })
                    }
                })
              }
        },
        makeUpdateConfirm(){
            swal.fire({
                text: `Request to change the Title, Cost of Song is subject to Admin's approval. Would you like to proceed?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
                }).then((result) => {
                if (result.isConfirmed) {
                    this.updateForm();
                }
                })
        },
        async updateForm(){
            const { value: formValues } = await swal.fire({
                title: 'Send Ticket',
                html:
                  `
                  <div class='alert alert-warning ' style='font-size:11px;text-align:left;'>
                    You are now requesting a change of either the Title or the Cost of your Song. Please fill out the necessary field/s that you wish to update in the boxes below and provide a brief explanation for the change.
                    <br><br>
                    However, please be reminded that changing your Song Title will require an amendment to your contract, and thus, will entail additional cost on your end.
                  </div>
                  <input id='password' type='password' placeholder='Enter your password here.' class='swal2-input'>
                  <input id='title' type='text' placeholder='Enter new title here.' class='swal2-input'>
                  <input id='cost' type='number' placeholder='Enter new cost here' class='swal2-input'>
                  <textarea id='reason' placeholder='Enter your reason' class='swal2-textarea' row='5' required></textarea>
                  `,
                focusConfirm: false,
                showCloseButton: true,
                showCancelButton: true,
                confirmButtonText:'Submit',
                preConfirm: () => {
                  return {
                    'password':document.getElementById('password').value,
                    'reason':document.getElementById('reason').value,
                    'title':document.getElementById('title').value,
                    'cost':document.getElementById('cost').value
                  }
                }
              })
              {{-- JSON.stringify(formValues) --}}
              if(!formValues.password.length){
                await swal.fire({
                    iconHtml:`<i class='fa fa-times text-danger'></i>`,
                    title: 'Please input your password',
                    showConfirmButton: false,
                    timer: 3000
                  })
                  this.updateForm();
              }
              else if (formValues) {
                axios.post('{{ route('tickets.song.update', $song) }}', formValues)
                .then(res=>{
                    if(res.data == 1){
                        swal.fire({
                            iconHtml:`<i class='fa fa-check text-success'></i>`,
                            title: 'Your ticket has been sent!',
                            showConfirmButton: false,
                            timer: 1500
                          })
                    }else if(res.data == 2){
                        swal.fire({
                            iconHtml:`<i class='fa fa-times text-danger'></i>`,
                            title: 'Your Password is wrong!',
                            showConfirmButton: false,
                            timer: 3000
                          })
                    }
                })
                .catch(err=>{
                    swal.fire({
                        iconHtml:`<i class='fa fa-times text-danger'></i>`,
                        title: 'Something went wrong!',
                        showConfirmButton: false,
                        timer: 3000
                      })
                })
              }
        }
    }">
        <button class="btn btn-danger" x-show="!showDeleteForm" type="button" x-on:click="makeConfirmation()"><i class="fa fa-trash" click="showDeleteForm"></i> Delete</button>
        <button class="btn btn-info" x-on:click="makeUpdateConfirm()" type="button" x-on:click="makeConfirmation()"><i class="fa fa-paper-plane" click="showDeleteForm"></i> Send Update Ticket</button>
    </div>
@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
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
    <script>
        CKEDITOR.replace('desc');
        CKEDITOR.replace('credits');
        CKEDITOR.replace('copyright');
        CKEDITOR.replace('lyrics');
    </script>
    <script src="/js/app.js"></script>
@endsection

