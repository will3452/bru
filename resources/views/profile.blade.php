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
                                <span class="description">text here</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading">10</span>
                                <span class="description">text here</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card-profile-stats">
                                <span class="heading">89</span>
                                <span class="description">text here</span>
                            </div>
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

                        <h6 class="heading-small text-muted mb-4">Login information</h6>

                        <div class="pl-lg-4">
                            <div class="row form-group">
                                <div class="col-12 focused">
                                    <label for="aan" class="form-control-label" >Account Awarded Number</label>
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
                                        <label class="form-control-label" for="last_name">Last name</label>
                                        <input type="text" id="last_name" class="form-control" disabled placeholder="Last name" value="{{ old('last_name', Auth::user()->last_name) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="email">Email address<span class="small text-danger">*</span></label>
                                        <input type="email" id="email" class="form-control" name="email" placeholder="example@example.com" value="{{ old('email', Auth::user()->email) }}">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="current_password">Current password</label>
                                        <input type="password" id="current_password" class="form-control" name="current_password" placeholder="Current password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="new_password">New password</label>
                                        <input type="password" id="new_password" class="form-control" name="new_password" placeholder="New password">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group focused">
                                        <label class="form-control-label" for="confirm_password">Confirm password</label>
                                        <input type="password" id="confirm_password" class="form-control" name="password_confirmation" placeholder="Confirm password">
                                    </div>
                                </div>
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
                                        <div>
                                            <i class="fa fa-signature"></i>
                                            <a  href="#" >
                                                {{ $pen->name }}
                                            </a>
                                        </div>
                                        <button class="btn btn-sm btn-circle p-1" onclick="$('#details{{ $pen->id }}').slideToggle(100)">
                                            <i class="fa fa-angle-down"></i>
                                        </button>
                                    </div>
                                    <div class="card shadow details mt-2" id="details{{ $pen->id }}">
                                        <div class="card-header py-1 ">
                                            <i class="fa fa-info-circle fa-xs"></i> Details
                                        </div>
                                        <div class="card-body">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    <i class="fa fa-venus-mars"></i> {{ $pen->gender }}
                                                </div>
                                                <div>
                                                    <i class="fa fa-map-marker-alt"></i> {{ $pen->country }}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            @if(auth()->user()->pens()->count() < 3)
                            <hr>
                        <form class="mt-4" method="POST" action="{{ route('penname.store') }}">
                            @csrf
                            
                                <div class="form-group">
                                    <label for="">Penname</label>
                                    <input type="text" name="name" class="form-control w-100" id="pen1">
                                    <div id="pen1-alert"></div>
                                </div>
                                <div class="form-group">
                                    <label for="#" class="d-block">Gender</label>
                                    <select name="gender" id="gender1" class="form-control w-100">
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                        <option  value="LGBTQIA+">LGBTQIA+</option>
                                        <option  value="undefined">Rather not to say</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="#" class="d-block" >Country</label>
                                    <select id="pen1country" type="text" name="country" class="form-control">
                                    </select>
                                </div>
                                <div class="alert alert-warning">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis, nemo?
                                </div>
                                <div class="form-group">
                                    <button class="btn btn-primary btn-block">
                                        Add pen
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
                                    <input type="text" class="form-control" disabled value="{{ auth()->user()->bio->gender }}">
                                </div>
                            </div>
                            <br>
                            <form class=" pl-lg-4">
                                <div class="row form-group">
                                    <div class="col-md-4">
                                        <label for="country">Country</label>
                                        <input type="text" class="form-control" disabled value="{{ auth()->user()->bio->country }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="city">City</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->bio->city }}">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="mobile">Mobile No.</label>
                                        <input type="text" class="form-control" value="{{ auth()->user()->bio->mobile }}">
                                    </div>
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

@endsection