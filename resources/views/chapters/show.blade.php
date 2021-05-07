@extends('layouts.admin')

@section('main-content')
    <h1>
        <span style="text-transform:capitalize"> {{ $chapter->mode }}</span>
    </h1>
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Details
                </div>
                <div class="card-body">
                    
                    @if ($book->category != 'Series')
                    <form action="{{ route('books.chapters.update', ['book'=>$book, 'chapter'=>$chapter]) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        @if (!in_array($chapter->mode, ['prolouge', 'epilouge']))
                            <div class="form-group">
                                <label for="">Title</label>
                                <input type="text" class="form-control" value="{{ $chapter->title}}" disabled>
                            </div>
                            <div class="form-group">
                                <label for="">Cost</label>
                                <input type="text" class="form-control" value="{{ $chapter->cost}}" disabled>
                            </div>
                        @endif

                        @if (in_array($chapter->type, ['premium_with', 'premium']))
                            <div class="form-group">
                                <label for="">Description</label>
                                <textarea name="desc" id="" cols="30" rows="10" class="form-control">{{ $chapter->desc }}</textarea>
                            </div>
                        @endif
                        <div class="form-group">
                            <label for="">Author's Notes </label>
                            <textarea name="foot_note" id="" cols="30" rows="10" class="form-control">{{ $chapter->foot_note }}</textarea>
                        </div>
                        
                        @if ($chapter->art)
                            <div class="form-group">
                                <a href="{{  $chapter->art }}" class="btn btn-success btn-sm" target="_blank">View Art Scene</a>
                            </div>
                            <div class="form-group">
                                <label for="">Art Cost</label>
                                <input type="text" class="form-control" value="{{ $chapter->art_cost}}" name="art_cost">
                            </div>
                        @endif
                        @if ($book->category == 'Novel' || $book->category == 'Anthology')
                            <div>
                                <label for="" class="d-block">Content</label>
                                <textarea name="content" id="nice" cols="30" rows="10">
                                    {{ $chapter->content }}
                                </textarea>
                            </div>
                        @else
                        <div class="">
                            <label for="" class="d-block">Content</label>
                            <input type="file" name="chapter_content" accept="application/pdf">
                            <a target="_blank" href="{{ $chapter->content }}" class="d-block text-secondary"><i class="fa fa-info-circle fa-sm"></i> View current content.</a>
                        </div>
                        @endif
                        
                        <button class="mt-2 btn btn-block btn-primary">Save</button>
                    </form>
                    @else 
                    {{-- if series --}}
                    @endif
                    <div class="mt-5">
                        <button class="btn btn-danger" x-on:click="confirm()" x-data="getDeleteData()">
                            <i class="fa fa-trash"></i> Delete
                        </button>

                        @if (!in_array($chapter->mode, ['prolouge', 'epilouge']))
                        <button class="btn btn-secondary" x-on:click="confirm()" x-data="getSendTicketData()">
                            <i class="fa fa-paper-plane"></i> Send Ticket
                        </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    Reports
                </div>
                <div class="card-body">
                    <div>
                        Reads
                    </div>
                    <div>
                        Hearts
                    </div>
                    <div>
                        Reviews & Comments
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('top')
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <script src="/js/app.js"></script>
@endsection
@section('bottom')
<script src="{{ asset('vendor/ckeditor/ckeditor.js') }}"></script>
<script>
     //rich editor
     CKEDITOR.replace('foot_note')
     CKEDITOR.replace('nice',{height:"50vh", toolbarGroups: [{
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
</script>

<script>
    function getDeleteData(){
        return {
            confirm(){
                swal.fire({
                    text: `Your request to delete your Chapter is subject to Admin's approval. Would you like to proceed?`,
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
                    });
            },
            async deleteForm(){
                const { value: formValues } = await swal.fire({
                        title: 'Send Ticket',
                        html:
                          `
                          <div class='alert alert-warning ' style='font-size:11px;text-align:left;'>
                            You are now requesting to delete your Chapter. Please fill out the necessary fields and provide a brief explanation for the request. 
                            <br><br>
                            However, please be reminded that your Chapter is under contract. Please confirm with BRUMULTIVERSE personally after submitting the request. 
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
                        axios.post('{{ route('tickets.chapter.delete', $chapter) }}', {password:formValues[0], reason:formValues[1]})
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
            }

        }
    }


    function getSendTicketData(){
        return {
            confirm(){
                    swal.fire({
                        text: `Request to change the Title, Cost of Chapter is subject to Admin's approval. Would you like to proceed?`,
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
                            You are now requesting a change of either the Title or the Cost of your chapter. Please fill out the necessary field/s that you wish to update in the boxes below and provide a brief explanation for the change.
                            <br><br>
                            However, please be reminded that changing your Chapter Title will require an amendment to your contract, and thus, will entail additional cost on your end.
                          </div>
                          <input id='password' type='password' placeholder='Enter your password here.' class='swal2-input'>
                          <input id='title' type='text' placeholder='Enter new title here.' class='swal2-input'>
                          <input id='cost' type='number' placeholder='Enter new cost here' class='swal2-input'>
                          <textarea id='reason' placeholder='Enter your reason' class='swal2-textarea' row='5' required></textarea>
                          `,
                        showCloseButton: true,
                        showCancelButton: true,
                        confirmButtonText:'Submit',
                        focusConfirm: false,

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
                        axios.post('{{ route('tickets.chapter.update', $chapter) }}', formValues)
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
        }
    }
</script>
@endsection