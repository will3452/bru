@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ $audio->title }}</h1>
    @include('partials.alert')
    <div class="d-flex justify-content-between mb-2 align-items-center">
        <a href="{{ route('books.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a> 
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
    @if ($audio->approved == null)
        <div x-data="{viewForm:false}">
            <div class="alert alert-warning">
                This Audio Book is not yet approved. click <a href="#" x-on:click.prevent="viewForm = true">HERE</a> to enter your approval CODE.
            </div>
            <div x-show="viewForm">
                <form action="{{ route('audio.update', $audio) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="">Code</label>
                        <input type="text" class="form-control" name="code">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">
                            Verify
                        </button>
                        <button class="btn btn-danger" x-on:click.prevent="viewForm = false">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <div class="card card-body my-2">
        <audio src="{{ $audio->audio }}" controls class="w-100" controlsList="nodownload"></audio>
    </div>
    <div class="row">
        <div class="col-lg-4 order-lg-2">
            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    <img src="{{ $audio->cover }}" alt="">
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{ $audio->title }}</h5>
                                <p class="text-capitalize">By <strong>{{ $audio->author }}</strong></p>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading"><i class="fa fa-heart"></i></span>
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
                                <span class="heading"><i class="fa fa-audio-reader"></i></span>
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
                    <h6 class="m-0 font-weight-bold text-primary">Audio Book Details</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('audio.updatesome', $audio) }}" autocomplete="off" id="updateForm">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="_method" value="PUT">
                        <div class="pl-lg-4">
                            <div class="form-group">
                                <label for="#">Title</label>
                                <input type="text" disabled class="form-control" value="{{ old('title') ?? $audio->title }}">
                            </div>
                            {{-- <div class="row form-group">
                                <div class="col-12 focused">
                                    <label for="#">Genre</label>
                                    <select name="genre" id="" class="form-control">
                                        <option value="Teen and Young Adult" {{ $audio->genre == 'Teen and Young Adult' ? 'selected':'' }}>Teen and Young Adult</option>
                                        <option value="New Adult" {{ $audio->genre == 'New Adult' ? 'selected':'' }}>New Adult</option>
                                        <option value="Romance " {{ $audio->genre == 'Romance ' ? 'selected':'' }}>Romance </option>
                                        <option value="Detective and Mystery" {{ $audio->genre == 'Detective and Mystery' ? 'selected':'' }}>Detective and Mystery</option>
                                        <option value="Action" {{ $audio->genre == 'Action' ? 'selected':'' }}>Action</option>
                                        <option value="Historical" {{ $audio->genre == 'Historical' ? 'selected':'' }}>Historical</option>
                                        <option value="LGBTQIA+" {{ $audio->genre == 'LGBTQIA+' ? 'selected':'' }}>LGBTQIA+</option>
                                    </select>
                                </div>
                            </div> --}}
                            <div class="form-grpup">
                                <label for="#">Language</label>
                                <select name="language" id="" class="form-control">
                                    <option value="English" {{ $audio->language == 'English' ? 'selected':'' }}>English</option>
                                    <option value="Filipino" {{ $audio->language == 'Filipino' ? 'selected':'' }}>Filipino</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Lead Character</label>
                                <select name="lead_character" id="" class="form-control">
                                    <option value="Male" {{ $audio->lead_character == 'Male' ? 'selected':''}}>Male</option>
                                    <option value="Female" {{ $audio->lead_character == 'Female' ? 'selected':''}}>Female</option>
                                    <option value="LGBTQIA+" {{ $audio->lead_character == 'LGBTQIA+' ? 'selected':''}}>LGBTQIA+</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Lead's College</label>
                                <select class="form-control" name="lead_college">
                                    <option value="Integrated School" {{ $audio->lead_college == 'Integrated School' ?'selected': '' }}>Integrated School</option>
                                    <option value="Berkeley" {{ $audio->lead_college == 'Berkeley' ? 'selected': '' }}>Berkeley</option>
                                    <option value="Reagan" {{ $audio->lead_college == 'Reagan' ? 'selected': '' }}>Reagan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="#">Blurb</label>
                                <textarea name="blurb" id="tetxArea" cols="30" rows="10" id="blurb">{{ old('blurb') ?? $audio->blurb }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="#">Cost</label>
                                <input type="number" disabled class="form-control" min="0" value="{{ $audio->cost }}">
                            </div>
                            <div class="form-group">
                                <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">1</sup></label>
                                <input type="text" value="{{ $audio->review_question_1 }}" class="form-control" name="review_question_1">
                            </div>
                            <div class="form-group">
                                <label for="#">Review Question <sup class="d-inline-block" style="width:20px;height:20px;">2</sup></label>
                                <input type="text" value="{{ $audio->review_question_2 }}" class="form-control" name="review_question_2">
                            </div>
                            <div class="form-group">
                                <label for="#">Credit Page</label>
                                <textarea name="credit_page" rows="10">{{ old('credit_page') ?? $audio->credit_page }}</textarea>
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

    @if($audio->approved != null )
      <div class="row">
          <div class="col-md-12">
              <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Publish Work</h6>
                  </div>
                  <div class="card-body">
                      
                      <form class=" pl-lg-4" method="POST" action="{{ route('audio.updatesome', $audio) }}">
                          @csrf
                          @method('PUT')
                          <div class="form-group">
                              <input type="text" id="pdate" name="publish_date" required readonly class="form-control" data-field="date" value="{{ $audio->publish_date }}">
                              <div id="dbox"></div>
                          </div>
                          <div class="form-group"></div>
                          <div class="row justify-content-center">
                              <button class="btn btn-primary">Set Publish Date</button>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
      @endif
      @if ($audio->approved != null)
      <div x-data="{
          showDeleteForm:false,
          makeConfirmation(){
              swal.fire({
              text: `Your request to delete your Audio Book is subject to Admin's approval. Would you like to proceed?`,
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
                      You are now requesting to delete your Audio Book. Please fill out the necessary fields and provide a brief explanation for the request. 
                      <br><br>
                      However, please be reminded that your Audio Book is under contract. Please confirm with BRUMULTIVERSE personally after submitting the request. 
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
                  axios.post('{{ route('tickets.audio.delete', $audio) }}', {password:formValues[0], reason:formValues[1]})
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
                  text: `Request to change the Title, Audio Book is subject to Admin's approval. Would you like to proceed?`,
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
                      You are now requesting a change of either the Title or the Cost of your Audio Book. Please fill out the necessary field/s that you wish to update in the boxes below and provide a brief explanation for the change.
                      <br><br>
                      However, please be reminded that changing your Audio Book Title will require an amendment to your contract, and thus, will entail additional cost on your end.
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
                  axios.post('{{ route('tickets.audio.update', $audio) }}', formValues)
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
      @endif
@endsection


@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
    
@endsection
@section('bottom')
    <script src="{{ asset('vendor/ckeditor/ckeditor.js') }}" defer></script>
    <script src="{{ asset('vendor\datepicker\DateTimePicker.min.js') }}"></script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}" defer></script>
    <script src="/js/app.js"></script>
    <script>
        $(function(){
            $('#dbox').DateTimePicker();
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

            //rich editor
            CKEDITOR.replace('blurb',{height:"50vh", toolbarGroups: [{
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
            CKEDITOR.replace('credit_page',{height:"50vh", toolbarGroups: [{
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
        })
    </script>
@endsection