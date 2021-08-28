@extends('layouts.admin')
@section('main-content')

    <h1>{{ $thrailer->title }}</h1>
    <div>
        <a href="{{ route('thrailers.index') }}" class="btn btn-primary btn-sm mb-2"><i class="fa fa-angle-left"></i> Back</a> 
    </div>
    @include('partials.alert')
    @if ($thrailer->approved == null)
        <div x-data="{viewForm:false}">
            <div class="alert alert-warning">
                This Trailer / Film / Animation is not yet approved. Click <a href="#" x-on:click.prevent="viewForm = true">HERE</a> to enter your approval CODE.
            </div>
            <div x-show="viewForm">
                <form action="{{ route('thrailers.update', $thrailer) }}" method="POST">
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Trailer / Film / Animation Details
                </div>
                <div class="card-body">
                    <form action="{{ route('thrailers.update', $thrailer) }}" method="POST">
                      @csrf
                      @method('PUT')
                        <div class="form-group">
                            <label for="">Title</label>
                            <input type="text" disabled value="{{ $thrailer->title }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="">Cost</label>
                            <input type="text" disabled value="{{ $thrailer->cost }}" class="form-control">
                        </div> 
                        <div class="form-group">
                            <label for="">Description</label>
                            <textarea name="desc" id="" cols="30" rows="5" class="form-control">{{ $thrailer->desc }}</textarea>
                        </div>          
                        <div class="form-group">
                            <label for="">Credits</label>
                            <textarea name="credit" id="" cols="30" rows="5" class="form-control">{{ $thrailer->credit }}</textarea>
                        </div>
                        <div class="form-group" x-data="{changeCover:false,showImage:false}">
                            <a href="{{ $thrailer->cover }}" target="_blank" class="btn btn-success btn-sm">View Cover</a>
                            <a href="#" class="btn btn-secondary btn-sm" x-on:click.prevent="changeCover = !changeCover">
                                <span x-show="!changeCover">Change Cover</span>
                                <span x-show="changeCover"><i class="fa fa-times"></i></span>
                            </a>
                            <template x-if="changeCover">
                                <div class="mt-2" >
                                    <div>
                                        <form action="{{ route('thrailers.cover.update', $thrailer) }}" method="POST" enctype="multipart/form-data">
                                            @csrf
                                            <input type="file" accept="image/*" name="cover" required>
                                            <button class="btn btn-success btn-sm">
                                                Update
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </template>
                            
                        </div>   
                        <div class="form-group">
                            <a href="{{ route('video.player', ['src'=>$thrailer->video]) }}" target="_blank"> <i class="fa fa-film fa-sm"></i> Show Video</a>
                        </div>
                        <div class="form-group">
                            <button class="btn btn-primary btn-block">
                                Save
                            </button>
                        </div>   
                    </form>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Reports
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        </div> --}}
    </div>
    @if($thrailer->approved != null )
      <div class="row">
          <div class="col-md-12">
              <div class="card shadow mb-4">
                  <div class="card-header py-3">
                      <h6 class="m-0 font-weight-bold text-primary">Publish Work</h6>
                  </div>
                  <div class="card-body">
                      
                      <form class=" pl-lg-4" method="POST" action="{{ route('thrailers.update', $thrailer) }}">
                          @csrf
                          @method('PUT')
                          <div class="form-group">
                              <input type="text" id="pdate" name="publish_date" required readonly class="form-control" data-field="date" value="{{ $thrailer->publish_date }}">
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

    @if ($thrailer->approved != null)
    <div x-data="{
        showDeleteForm:false,
        makeConfirmation(){
            swal.fire({
            text: `Your request to delete your Film / Trailer / Animation is subject to Admin's approval. Would you like to proceed?`,
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
                    You are now requesting to delete your Film / Trailer / Animation. Please fill out the necessary fields and provide a brief explanation for the request. 
                    <br><br>
                    However, please be reminded that your Film / Trailer / Animation is under contract. Please confirm with BRUMULTIVERSE personally after submitting the request. 
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
                axios.post('{{ route('tickets.thrailer.delete', $thrailer) }}', {password:formValues[0], reason:formValues[1]})
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
                text: `Request to change the Title, Cost of Film / Trailer / Animation is subject to Admin's approval. Would you like to proceed?`,
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
                    You are now requesting a change of either the Title or the Cost of your Film / Trailer / Animation. Please fill out the necessary field/s that you wish to update in the boxes below and provide a brief explanation for the change.
                    <br><br>
                    However, please be reminded that changing your Film / Trailer / Animation Title will require an amendment to your contract, and thus, will entail additional cost on your end.
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
                axios.post('{{ route('tickets.thrailer.update', $thrailer) }}', formValues)
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
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}">
    <script src="/js/app.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine.js" integrity="sha512-nIwdJlD5/vHj23CbO2iHCXtsqzdTTx3e3uAmpTm4x2Y8xCIFyWu4cSIV8GaGe2UNVq86/1h9EgUZy7tn243qdA==" crossorigin="anonymous"></script>
@endsection
@section('bottom')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('vendor\datepicker\DateTimePicker.min.js') }}"></script>
<script>
    $('#dbox').DateTimePicker();
    CKEDITOR.replace('desc',{height:"50vh", toolbarGroups: [{
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
  CKEDITOR.replace('credit',{height:"50vh", toolbarGroups: [{
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
</script>
@endsection