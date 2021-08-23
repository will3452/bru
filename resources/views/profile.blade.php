@extends('layouts.admin')

@section('main-content')

    @if ($errors->any())
        <div class="alert alert-danger border-left-danger" role="alert">
            <ul class="pl-4 my-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

        <div class="col-lg-4 order-lg-2">

            <div class="card shadow mb-2">
                <div class="card-profile-image mt-4">
                    @if(!auth()->user()->picture)
                        <figure class="rounded-circle avatar avatar font-weight-bold" style="font-size: 60px; height: 180px; width: 180px;" data-initial="{{ Auth::user()->first_name[0] }}"></figure>
                    @else
                        <img src="{{ auth()->user()->picture }}" class=" avatar rounded-circle" style=" object-fit:cover;height: 180px !important; width: 180px !important;"  alt="">
                    @endif
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center">
                                <h5 class="font-weight-bold">{{  Auth::user()->fullName }}</h5>
                                <p class="text-capitalize">{{ Auth::user()->role }}</p>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class= mt-3" x-data="{showCreate:false}">
                            @if (auth()->user()->groups()->count())
                                <h5><i class="fa fa-users"></i> Groups</h5>
                                <div class="alert alert-warning">
                                    NOTE: Please create a group only if you're collaborating on ONE MATERIAL. For a collection of individual works, please Create Series instead.
                                </div>
                                <ul class="list-group">
                                    @foreach (auth()->user()->groups as $group)
                                        <li class="list-group-item d-flex justify-content-between">
                                            <div>
                                                <a href="{{ route('group.show', $group->id) }}">{{ $group->name }}</a>
                                            </div>
                                            <div>
                                                {{ $group->status }}
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                            <div class="text-center">
                                <button class="btn btn-primary"  x-show="!showCreate" x-on:click="showCreate = !showCreate">
                                    <div x-show="!showCreate">
                                        <i class="fa fa-plus"></i> Create Group
                                    </div>
                                </button>
                            </div>
                            <div x-show.transition="showCreate" class="mt-2">
                                
                                <form action="{{ route('group.store') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="">Group Name</label>
                                        <input type="text" name="name" required class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="">Group Type</label>
                                        <select name="type" id="" class="form-control">
                                            @foreach (\App\GroupType::get() as $type)
                                                <option value="{{ $type->name }}">{{ $type->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button  type="button" class="btn btn-danger btn-sm" x-on:click="showCreate = !showCreate">
                                        <div  x-show="showCreate">
                                            Cancel
                                        </div>
                                    </button>
                                    <button class="btn btn-primary btn-sm">
                                        Submit
                                    </button>
                                    
                                </form>
                            </div>
                    </div>
                </div>
            </div>

            
        </div>

        <div class="col-lg-8 order-lg-1">

            <div class="card shadow mb-4">

                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">My Account</h6>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update') }}" autocomplete="off">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <input type="hidden" name="_method" value="PUT">

                        <h6 class="heading-small text-muted mb-4">Login Information</h6>

                        <div class="pl-lg-4">
                            <div class="row form-group">
                                <div class="col-12 focused">
                                    <label for="aan" class="form-control-label" >ID Number (Awarded Account Number)</label>
                                    <input type="text" class="form-control" disabled value="{{ auth()->user()->aan_string ?? ''}}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="name">First Name<span class="small text-danger">*</span></label>
                                        <input type="text" id="name" class="form-control" disabled placeholder="Name" value="{{ old('first_name', Auth::user()->first_name) }}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="last_name">Last Name</label>
                                        <input type="text" id="last_name" class="form-control" disabled placeholder="Last name" value="{{ old('last_name', Auth::user()->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email Address<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>
                            
                            @livewire('profile.change-password')
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
            @if (auth()->user()->pens()->count() == 0)
               <script>
                   swal.fire({
                       iconHtml:`<i class="fa fa-check"></i>`,
                       text:'You\'re all set! Here\'s your profile page. Create one to three pen names to begin uploading your masterpieces. Once used on any uploaded work, pen names become permanent. Welcome!',
                       confirmButtonText:'OK',
                   })
               </script>
            @endif
            <div class="row" id="pen">
                <div class="col-md-12">
                    <div class=" card shadow mb-2">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Pen Names</h6>
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> Please note that your pen names become permanent when used on an uploaded material.
                            </div>
                            <ul class="list-unstyled" >
                                @foreach(auth()->user()->pens as $pen)
                                <li class="px-0">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="d-flex">
                                            <a target="_blank" href="{{ $pen->picture ?? '/img/emptyuserimage.png' }}">
                                                <img src="{{ $pen->picture ?? '/img/emptyuserimage.png' }}" alt="" style="width:25px;height:25px;object-fit:cover;margin-right:10px;">
                                            </a>
                                            <a  href="#" >
                                                {{ $pen->name }}
                                            </a>
                                            @if ($pen->canDelete())
                                            <form action="{{ route('penname.destroy', $pen->id) }}" class="ml-2" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button class="text-danger border-0 bg-white">
                                                    Delete
                                                </button>
                                            </form>
                                            @endif
                                        </div>
                                        <div class="d-flex">
                                            
                                            <button class="btn btn-sm btn-circle p-1" onclick="$('#details{{ $pen->id }}').slideToggle(100)">
                                                <i class="fa fa-angle-down"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card shadow details mt-2" id="details{{ $pen->id }}">
                                        <div class="card-header py-1 ">
                                            <i class="fa fa-info-circle fa-xs"></i> Details
                                        </div>
                                        <div class="card-body">
                                            {{-- <div class="d-flex justify-content-between">
                                                <div style="text-transform: capitalize">
                                                    <i class="fa fa-venus-mars"></i> {{ $pen->gender }}
                                                </div>
                                                <div>
                                                    <i class="fa fa-map-marker-alt"></i> {{ $pen->country }}
                                                </div>
                                            </div> --}}
                                            <div class="mb-2"  x-data="{
                                                openform:false,
                                            }">
                                                <img src="{{ $pen->picture ?? '/img/emptyuserimage.png' }}" alt="" style="width:100px;height:100px;object-fit:cover;" x-show="!openform">
                                            </div>
                                            <table class="table table-striped">
                                                <tr>
                                                    <th>
                                                        Gender
                                                    </th>
                                                    <td style="text-transform: capitalize">
                                                        {{ $pen->gender }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Country
                                                    </th>
                                                    <td style="text-transform: capitalize">
                                                        {{ $pen->country }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @if(auth()->user()->pens()->count() < 3)
                            <hr>
                        {{-- <form class="mt-4" method="POST" action="{{ route('penname.store') }}" enctype="multipart/form-data"> --}}
                           <div x-data="{
                            croppie:new Croppie(document.querySelector('#image'), {
                                viewport: { width: 200, height: 200 },
                                boundary: { width: 250, height: 250 },
                                showZoomer: true,
                                enableResize: true,
                                enableOrientation: true,
                                mouseWheelZoom: 'ctrl'
                            }),
                            file:'',
                            fetchImage(){
                                URL.revokeObjectURL(this.file)
                                this.file = URL.createObjectURL(this.$refs.file.files[0]);
                                this.croppie.bind({
                                    url:this.file
                                });
                            },
                            submitting:false,
                            async submitForm(){
                                this.$refs.formBtn.disabled = true;
                                this.submitting = true;
                                const formData = new FormData(this.$refs.form);
                                

                                await this.croppie.result('blob')
                                .then(async function(blob){
                                    blob.name = await `${uuidv4()}.jpg`;
                                    blob.lastModifiedDate  = await new Date();
                                    formData.set('picture', blob, blob.name)
                                })
                                
                                axios({
                                    method: 'post',
                                    url:`{{ route('penname.store') }}`,
                                    data: formData,
                                    headers: { 'Content-Type': 'multipart/form-data' },
                                  })
                                  .then(function(res){
                                      if(res.data == 'refresh'){
                                          window.location.href=`{{ url()->current() }}`;
                                      }
                                  })
                            }

                            
                        }">
                            <form class="mt-4" x-ref="form" method="POST" action="#" enctype="multipart/form-data" x-on:submit.prevent="submitForm()">
                                @csrf
                                   
                                    <div class="form-group">
                                        <label for="">Pen Name</label>
                                        <input type="text" name="name" class="form-control w-100" id="pen1" required>
                                        <div id="pen1-alert"></div>
                                    </div>
                                    <div class="form-group">
                                        <label for="#" class="d-block">Gender</label>
                                        <select name="gender" id="gender1" class="form-control w-100">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option  value="LGBTQIA+">LGBTQIA+</option>
                                            <option  value="undefined">Rather not say</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="#" class="d-block" >Country</label>
                                        <select id="pen1country" type="text" name="country" class="form-control">
                                        </select>
                                    </div>
                                    <div class="form-group" >
                                        
                                        <label for="">
                                            Photo
                                        </label>
                                        <div class="alert alert-info">
                                            <i class="fa fa-info-circle"></i> This is the profile photo of your pen name or your scholar persona. This will be shown to the public. 
                                        </div>
                                        <div id="image"></div>
                                        
                                       <div>
                                        <input type="file" x-ref="file" name="picture" class="d-block mt-2" accept=".png, .jpg" x-on:change="fetchImage()" x-on:click="" required>
                                        
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-block" x-ref="formBtn">
                                           <img src="{{ asset('/images/loading.gif') }}" alt="" style="width:25px;" x-show="submitting"> Add Pen Name
                                        </button>
                                    </div>
                                </form>
                           </div>
                            @endif
                        </div>
                    </div>
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">My Bio</h6>
                        </div>
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">User Information</h6>
                            <div class="row pl-lg-4">
                                <div class="col-md-6">
                                    <label for="bdate">Birthdate</label>
                                    <input type="text" class="form-control" disabled value="{{ auth()->user()->bio->bday->format('M d, Y') }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="gender">Gender</label>
                                    <input type="text" class="form-control" style="text-transform: capitalize;" disabled value="{{ auth()->user()->bio->gender }}">
                                </div>
                            </div>
                            <br>
                            <form class=" pl-lg-4">
                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" disabled value="{{ auth()->user()->bio->country }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->bio->city }}">
                                    </div>
                                    {{-- <div class="col-md-4">
                                        <label for="mobile">Mobile No.</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->bio->mobile }}">
                                    </div> --}}
                                </div>
                                {{-- <div class="row justify-content-center">
                                    <button class="btn btn-primary">Save Changes</button>
                                </div> --}}
                                
                            </form>
                            
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    

@endsection
@section('top')
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <link rel="stylesheet" href="/css/croppie.css">
@endsection
@section('bottom')
<script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
<script src="/js/app.js"></script>
<script src="/js/croppie.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuidv4.min.js" integrity="sha512-BCMqEPl2dokU3T/EFba7jrfL4FxgY6ryUh4rRC9feZw4yWUslZ3Uf/lPZ5/5UlEjn4prlQTRfIPYQkDrLCZJXA==" crossorigin="anonymous"></script>
<script src="{{ asset('js/countries.js') }}"></script>
<script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@livewireStyles()
<script>
    $(function(){
        $('.details').hide();
        $.each(countries, function(index, val){
                if(val.name == '{{ old('country') ?? 'Philippines' }}') {
                    $('#pen1country').append(`<option selected value="${val.name}">${val.name}</option>`);
                }
                else {
                    $('#pen1country').append(`<option value="${val.name}">${val.name}</option>`);
                }
            });
        $('#pen1country').select2();

        $('#pen1').keyup(function(e){
                $.post('{{ route("pen.check") }}', {name:$(this).val()}, function(data, res){
                    $('#pen1').removeClass('is-invalid');
                    $('#pen1').removeClass('is-valid');
                    $('#pen1').addClass(data.inputclass);
                    $('#pen1-alert').removeClass('alert alert-danger');
                    $('#pen1-alert').removeClass('alert alert-success');
                    $('#pen1-alert').addClass('alert py-1 '+data.alertclass);
                    $('#pen1-alert').text(data.msg);
                })
                
            });
    })
    

</script>
@livewireScripts()
@endsection

