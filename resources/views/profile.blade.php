@extends('layouts.admin')

@section('main-content')
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">{{ __('Profile') }}</h1>

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

                    <div class="row">
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading">22</span>
                                <span class="description">Followers</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading">10</span>
                                <span class="description">Works</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading">89</span>
                                <span class="description">Likes</span>
                            </div>
                        </div>
                    </div>
                    <div class=" mt-3" x-data="{showCreate:false}">
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
                                            {{ $group->approved ? 'Approved':'Not Approved' }}
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                        <button class="btn btn-primary mt-2" x-on:click="showCreate = !showCreate">
                            <div x-show="!showCreate">
                                <i class="fa fa-plus"></i> Create Group
                            </div>
                            <div  x-show="showCreate">
                                <i class="fa fa-times"></i> Cancel
                            </div>
                        </button>
                        <div x-show.transition="showCreate" class="mt-2">
                            <hr>
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
                                <button class="btn btn-primary">
                                    <i class="fa fa-upload"></i> Submit
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

            <div class="row">
                <div class="col-md-12">
                    <div class=" card shadow mb-2">
                        <div class="card-body">
                            <h6 class="heading-small text-muted mb-4">Pen Names</h6>
                            <div class="alert alert-warning">
                                <i class="fa fa-warning"></i> Please note that your pen names, when used on a book, will be permanent. 
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
                                            <div class="mb-2">
                                                <img src="{{ $pen->picture ?? '/img/emptyuserimage.png' }}" alt="" style="width:100px;height:100px;object-fit:cover;">
                                                <div x-data="{
                                                    openform:false
                                                }">
                                                    <a href="#" x-on:click.prevent="openform=true">Change picture</a>
                                                    <div class="card card-body" x-show.transition="openform">
                                                        <form action="{{ route('penname.update.picture') }}" enctype="multipart/form-data" method="POST">
                                                            @csrf
                                                            <input type="file" name="picture" required accept=".png, .jpg">
                                                            <input type="hidden" name="pen_id" value="{{ $pen->id }}">
                                                            <div class="mt-2">
                                                                <button class="btn btn-success btn-sm"><i class="fa fa-check"></i> Save</button>
                                                                <button class="btn btn-secondary btn-sm" x-on:click.prevent="openform=false"><i class="fa fa-times"></i> Cancel</button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
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
                        <form class="mt-4" method="POST" action="{{ route('penname.store') }}" enctype="multipart/form-data">
                            @csrf
                                <div class="form-group" x-data="{
                                    fetchImage(){
                                        URL.revokeObjectURL(this.$refs.image.src);
                                        let file = this.$refs.file.files[0];
                                        let url = URL.createObjectURL(file);
                                        this.$refs.image.src = url;
                                    }
                                }">
                                    <label for="">
                                        Photo
                                    </label>
                                    <div class="alert alert-info">
                                        <i class="fa fa-info-circle"></i> This is the profile photo of your pen name or your scholar persona. This will be shown to the public. 
                                    </div>
                                    <img src="/img/emptyuserimage.png" x-ref="image" alt="" style="width:100px;height:100px;object-fit:cover;">
                                    <input type="file" x-ref="file" name="picture" class="d-block mt-2" accept=".png, .jpg" x-on:change="fetchImage()" x-on:click="" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Pen Name</label>
                                    <input type="text" name="name" class="form-control w-100" id="pen1">
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
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">
                                        Add Pen Name
                                    </button>
                                </div>
                            </form>
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
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}"> --}}
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
@endsection
@section('bottom')
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

