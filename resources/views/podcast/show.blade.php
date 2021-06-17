@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $podcast->title }}</h1>
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <a href="{{ route('podcast.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back to My Works</a> 
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
        <audio src="{{ $podcast->file }}" controls class="w-100" controlsList="nodownload"></audio>
    </div>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    <img src="{{ $podcast->cover }}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $podcast->title }}</h5>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-hepodcast"></i></span>
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
                    <h6 class="m-0 font-weight-bold text-primary">podcast Details</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('podcast.update', $podcast) }}" autocomplete="off" id="updateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="pl-lg-4">

                            <div class="form-group">
                                <label for="#">Title</label>
                                <input type="text" class="form-control" value="{{ old('title') ?? $podcast->title }}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="#">Episode Type</label>
                                <input class="form-control" disabled value="{{ $podcast->episode_type }}">
                            </div>
                            <div class="form-group">
                                <label for="#">Host</label>
                                <input class="form-control" type="host" name="host" value="{{ $podcast->host }}">
                            </div>
                            <div class="form-group">
                                <label for="#">{{ $podcast->episode_type == 'regular' ? 'Hall pass':'purple crystal' }}</label>
                                <input class="form-control" disabled type="text" id="cost" value="{{ $podcast->cost }}">
                            </div>
                            <div class="form-group">
                                <label for="#">Audio Desciption</label>
                                <audio src="{{ $podcast->audio_desc }}" controls class="w-100" controlsList="nodownload"/>
                            </div>
                            <div class="form-group">
                                <label for="#">Description</label>
                                <textarea name="desc" class="form-control" >{{ old('desc') ?? $podcast->desc }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="#">Credits </label>
                                <textarea name="credits" class="form-control">{{ old('credits') ?? $podcast->credits }}</textarea>
                            </div>
                        </div>
                        <!-- Button -->
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="button" onclick="under dev" class="btn btn-primary">Save Changes</button>
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
            text: `Your request to delete your podcast is subject to Admin's approval. Would you like to proceed?`,
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
                    You are now requesting to delete your podcast. Please fill out the necessary fields and provide a brief explanation for the request. 
                    <br><br>
                    However, please be reminded that your podcast is under contract. Please confirm with BRUMULTIVERSE personally after submitting the request. 
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
                axios.post('{{ route('tickets.podcast.delete', $podcast) }}', {password:formValues[0], reason:formValues[1]})
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
                text: `Request to change the Title, Cost of podcast is subject to Admin's approval. Would you like to proceed?`,
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
                    You are now requesting a change of either the Title or the Cost of your podcast. Please fill out the necessary field/s that you wish to update in the boxes below and provide a brief explanation for the change.
                    <br><br>
                    However, please be reminded that changing your podcast Title will require an amendment to your contract, and thus, will entail additional cost on your end.
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
                axios.post('{{ route('tickets.podcast.update', $podcast) }}', formValues)
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
    </script>
    <script src="/js/app.js"></script>
@endsection

