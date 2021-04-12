@extends('layouts.auth')

@section('main-content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card o-hidden border-0 shadow-lg my-5 card-bg-custom">
                <div class="card-body p-0">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="p-5">
                                <div class="text-left">
                                    <h1 class="h4 text-white mb-4">Complete Registration Form</h1>
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

                                <form method="POST" action="{{ route('register') }}" class="user" enctype="multipart/form-data">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="aan" value="{{ $aan }}">
                                    <h5><i class="fa fa-user-circle"></i> Account Information</h5>
                                    <hr>
                                    <!-- <div class="form-group">
                                        <label for="aan">Account Activation Number (AAN)</label>
                                        <div class="form-group">
                                            <input type="text" class=" form-control form-control" name="aan" id="aan" placeholder="********">
                                            <small class="text-helper"></small>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <label for="role">Register as an </label> 
                                        <select name="role" id="" class="custom-select" value="{{ old('role') }}">
                                            <option value="author">
                                                Author
                                            </option>
                                            <option value="artist">
                                                Artist
                                            </option>
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="      w-100 form-control rounded " name="first_name" placeholder="{{ __('First name') }}" value="{{ old('first_name') }}" required autofocus>
                                        </div>
    
                                        <div class="form-group col-md-6">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="      w-100 form-control rounded " name="last_name" placeholder="{{ __('Last Name') }}" value="{{ old('last_name') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label for="sex">Sex</label>
                                            <select name="sex" id="sex" class="custom-select" value="{{ old('sex') }}">
                                                <option {{ old('gender') == 'male' ? 'selected':'' }}value="male">Male</option>
                                                <option {{ old('gender') == 'female' ? 'selected':'' }}value="female">Female</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="gender">Gender</label>
                                            <select name="gender" id="gender" class="custom-select" value="{{ old('gender') }}">
                                                <option {{ old('gender') == 'male' ? 'selected':'' }}value="male">Male</option>
                                                <option {{ old('gender') == 'female' ? 'selected':'' }}value="female">Female</option>
                                                <option {{ old('gender') == 'LGBTQ+' ? 'selected':'' }} value="LGBTQ+">LGBTQ+</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="email">Email Address</label>
                                        <input type="email" class="      w-100 form-control rounded " name="email" placeholder="{{ __('E-Mail Address') }}" value="{{ old('email') }}" id="email" required>
                                        <div id="emailAlert"></div>
                                    </div>

                                    <div class="row" id="password-app">
                                        <div class="form-group col-md-6">
                                            <label for="password">Password</label>
                                            <input type="password" class="w-100 form-control rounded " v-model="fpassword" name="password" placeholder="{{ __('Password') }}" required>
                                        </div>
    
                                        <div class="form-group col-md-6">
                                            <label for="#">Confirm Password</label>
                                            <input type="password" :class="{'is-invalid':passwordMatch()}" class="      w-100 form-control rounded" v-model="spassword" name="password_confirmation" placeholder="{{ __('Confirm Password') }}" required>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="#">Birthdate</label>
                                            <input id="bdate" type="text" required value="{{ old('birthdate') }}" readonly name="birthdate" data-field='date' class="   w-100 form-control rounded" style="border:1px solid #ccc">
                                            <div id="dbox"></div>
                                        </div>
                                        <div class="col-md-8">
                                            <div class="form-group row">
                                                <div class="col-md-6">
                                                    <label for="" class="d-block">Country</label>
                                                    <select name="country" id="country" class="form-control input-lg" style="width:100% !important; display:block !important;" class="d-block" >
                                                    </select>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="">City</label>
                                                    <input style="border:1px solid #ccc" type="text" name="city"  required class="   w-100 form-control rounded" placeholder="City">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    @livewire('register.choose-picture')
                                    <div class="alert alert-danger mt-2">
                                        <i class="fa fa-info-circle"></i> NOTE: This is your account profile picture and will not be shown to the public. This is only for reference of the Admin.  Please use your actual photo for this part. 
                                    </div>
                                    <div class="alert alert-warning mt-2">
                                        <div>
                                            <strong>Required*</strong>
                                        </div>
                                        <input type="checkbox" id="ck_box3" name="cpy" required>
                                        @copyright_disclaimer
                                    </div>
                                    <h5 class="mt-4"><i class="fa fa-signature"></i> Pen names</h5>
                                    <hr>
                                    <div class="alert alert-warning">
                                        Please note that the pen name, when already used in a book, will be permanent.
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="card card-body bg-transparent">
                                                <div class="form-group">
                                                    <label for="#" class="d-block">Pen Name 1</label>
                                                    <input type="text" name="penname[]" class="form-control w-100" id="pen1" required>
                                                    <div id="pen1-alert"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#" class="d-block">Gender</label>
                                                    <select name="pengender[]" id="gender1" class="form-control w-100">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option  value="LGBTQIA+">LGBTQIA+</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#" class="d-block" >Country</label>
                                                    <select id="pen1country" type="text" name="pencountry[]" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="card card-body bg-transparent">
                                                <div class="form-group">
                                                    <label for="#" class="d-block">Pen Name 2</label>
                                                    <input type="text" name="penname[]" class="form-control w-100" id="pen2">
                                                    <div id="pen2-alert"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#" class="d-block">Gender</label>
                                                    <select name="pengender[]" id="gender2" class="form-control w-100">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option  value="LGBTQIA+">LGBTQIA+</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#" class="d-block" >Country</label>
                                                    <select id="pen2country" type="text" name="pencountry[]" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class=" card card-body bg-transparent">
                                                <div class="form-group">
                                                    <label for="#" class="d-block">Pen Name 3</label>
                                                    <input type="text" name="penname[]" class="form-control w-100" id="pen3">
                                                    <div id="pen3-alert"></div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#" class="d-block">Gender</label>
                                                    <select name="pengender[]" id="gender3" class="form-control w-100">
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option  value="LGBTQ+">LGBTQ+</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="#" class="d-block" >Country</label>
                                                    <select id="pen3country" type="text" name="pencountry[]" class="form-control">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                   <h5 class="mt-5">
                                       <i class="fa fa-heart"></i> Interest
                                   </h5>
                                   <hr>
                                   <div class="row">
                                       <div class="col-md-4">
                                           <label for="#">BRU College</label>
                                           <select name="interest[]" class="form-control w-100 selectme" id="college" >
                                               <option value="Integrated School">Integrated School</option>
                                               <option value="Berkeley Business And Sciences">Berkeley Business And Sciences</option>
                                               <option value="Reagan Arts And Humanities">Reagan Arts And Humanities</option>
                                           <select>
                                       </div>
                                       <div class="col-md-4">
                                        <label for="#">BRU Course</label>
                                        <select name="interest[]" class="form-control w-100 selectme" id="courses">
                                            <option value="Sports Science" class="berkeley">Sports Science</option>
                                            <option value="Business and Corporate Management" class="berkeley">Business and Corporate Management</option>
                                            <option value="Sports Science" class="berkeley">Sports Science</option>
                                            <option value="Economics" class="berkeley">Economics</option>
                                            <option value="Accountancy" class="berkeley">Accountancy</option>
                                            <option value="Biology" class="berkeley">Biology</option>
                                            <option value="Nursing" class="berkeley">Nursing</option>
                                            <option value="Intellectual Property" class="berkeley">Intellectual Property</option>
                                            <option value="Medicine" class="berkeley">Medicine</option>
                                            <option value="Law" class="berkeley">Law</option>
                                            <option value="Dance" class="reagan">Dance</option>
                                            <option value="Music" class="reagan">Music</option>
                                            <option value="Drama and Theater Arts" class="reagan">Drama and Theater Arts</option>
                                            <option value="Communication Arts (film, photography, film and video, print and broadcast)" class="reagan">Communication Arts (film, photography, film and video, print and broadcast)</option>
                                            <option value="Fine and Studio Arts" class="reagan">Fine and Studio Arts</option>
                                            <option value="Design and Applied Arts" class="reagan">Design and Applied Arts</option>
                                            <option value="History and Literature" class="reagan">History and Literature</option>
                                            <option value="Linguistics" class="reagan">Linguistics</option>
                                            <option value="Literature" class="reagan">Literature</option>
                                            <option value="Foreign Languages" class="reagan">Foreign Languages</option>
                                            <option value="International Studies" class="reagan">International Studies</option>
                                            <option value="Political Science" class="reagan">Political Science</option>
                                            <option value="Psychology" class="reagan">Psychology</option>
                                            <option value="Women's Studies" class="reagan">Women's Studies</option>
                                            <option value="Senior High School" class="integ">Senior High School</option>
                                            <select>
                                        </div>
                                        <div class="col-md-4">
                                        <label for="#">BRU Club</label>
                                        <select name="interest[]" class="form-control w-100 selectme" id="club">
                                            <option value="Junior BRAT@sports" class="is">Junior BRAT</option>
                                            <option value="Junior MAC@media arts" class="is">Junior MAC</option>
                                            <option value="Junior PAS@performing arts" class="is">Junior PAS</option>
                                            <option value="Junior Innovators@science" class="is">Junior Innovators</option>
                                            <option value="Junior MATHletes@math" class="is">Junior MATHletes</option>
                                            <option value="Philantrophist@volunteerism" class="is">Philantrophist</option>
                                            <option value="Talakayan@speech and debate" class="is">Talakayan</option>
                                            <option value="Junior Roots@culture and traditions" class="is">Junior Roots</option>
                                            <option value="Senior High Extremes@outdoor and extreme sports" class="is">Senior High Extremes</option>
                                            <option value="Junior Maison@home economics" class="is">Junior Maison</option>
                                            <option value="Junior Entrepreneurs@business" class="is">Junior Entrepreneurs</option>
                                            <option value="Junior Bibliophile@book club" class="is">Junior Bibliophile</option>
                                            <option value="Senior High Voyagers@travel" class="is">Senior High Voyagers</option>
                                            <option value="Junior Green Thumb@plant lovers" class="is">Junior Green Thumb</option>
                                            <option value="Junior Furparents@pet-lovers" class="is">Junior Furparents</option>
                                            <option value="BRU Athletics (BRAT)@sports" class="college">BRU Athletics (BRAT)</option>
                                            <option value="BRU Media Arts Club (BRU MAC)@media arts" class="college">BRU Media Arts Club (BRU MAC)</option>
                                            <option value="BRU Performing Arts Society (BRU PAS)@performing arts" class="college">BRU Performing Arts Society (BRU PAS)</option>
                                            <option value="BRU Innovators@science" class="college">BRU Innovators</option>
                                            <option value="BRU MATHletes@math" class="college">BRU MATHletes</option>
                                            <option value="BRU Social Responsibility Club@volunteerism" class="college">BRU Social Responsibility Club</option>
                                            <option value="BRU Speech and Debate Club@speech and debate" class="college">BRU Speech and Debate Club</option>
                                            <option value="BRU Heritage Club@culture and traditions" class="college">BRU Heritage Club</option>
                                            <option value="BRU Extremes@outdoor and extreme sports" class="college">BRU Extremes</option>
                                            <option value="BRU Maison@home economics" class="college">BRU Maison</option>
                                            <option value="BRU Entrepreneurs@business" class="college">BRU Entrepreneurs</option>
                                            <option value="BRU Bibliophiles@book club" class="college">BRU Bibliophiles</option>
                                            <option value="BRU Voyagers@travel" class="college">BRU Voyagers</option>
                                            <option value="BRU and Green@plant lovers" class="college">BRU and Green</option>
                                            <option value="BRU Furparents@pet-lovers" class="college">BRU Furparents</option>
                                        </select>
                                        </div>
                                   </div>

                                   <div class="row">
                                        <div class="col-md-6">
                                            <div>
                                                <h5 class="mt-5">
                                                    <i class="fa fa-thumbs-up"></i> TERMS AND CONDITIONS
                                                </h5>
                                                <p>
                                                    <input type="checkbox" id="ck_box1">I have read and I agree with the <a href="#">Terms and Conditions</a>
                                                </p>
                                            </div>
                                            <div>
                                                <h5 class="mt-5">
                                                    <i class="fa fa-check"></i> ARE YOU SURE ABOUT ALL THE INFORMATION YOU HAVE DECLARED?
                                                </h5>
                                                <p class="text-justify">
                                                    <input type="checkbox" id="ck_box5"> I certify that all information I have declared in this registration are true and correct to the best of my knowledge. I further understand that any false statement may result in denial or revocation of my account.
                                                </p>
                                            </div>
                                        </div>
    
                                       <div class="col-md-6">
                                        <div>
                                            <h5 class="mt-5">
                                                <i class="fa fa-arrow-down"></i> COPYRIGHT CERTIFICATION
                                            </h5>
                                            <p class="text-justify">
                                                <input type="checkbox" id="ck_box4"> This is to reaffirm my duty to ensure all materials that I upload on the BRUMULTIVERSE site and/or app are my property, and that I own the rights to them or I have obtained approval in writing to use them, as stated in my contact with BRUMULTIVERSE.
                                            </p>
                                        </div>
                                        <div>
                                            <h5 class="mt-5">
                                                <i class="fa fa-lock"></i> DATA PRIVACY
                                            </h5>
                                            <p>
                                                 <input type="checkbox" id="ck_box2">I have read and I agree with the <a href="#">Privacy Policy</a>
                                             </p>
                                           </div>
                                        </div>
                                   </div>
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-block" id="register_btn">
                                            {{ __('Register') }} <i class="fa fa-check-circle"></i>
                                        </button>
                                    </div>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('login') }}">
                                        {{ __('Already have an account? Please log in.') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('top')
    @livewireStyles
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor\datepicker\DateTimePicker.css') }}">
    <link rel="stylesheet" href="{{ asset('vendor/select2/select2-bootstrap.min.css') }}">
    <style>
        .form-control {
            border:1px solid #aaa !important;
            padding-top:1px !important;
        }
    </style>
@endsection
@section('bottom')
@livewireScripts
    <script src="{{ asset('vendor\datepicker\DateTimePicker.min.js') }}"></script>
    <script src="{{ asset('js/countries.js') }}"></script>
    <script>
        $(function(){
            $('#dbox').DateTimePicker();


            //init countries
            $.each(countries, function(index, val){
                if(val.name == '{{ old('country') ?? 'Philippines' }}') {
                    $('#country').append(`<option selected value="${val.name}">${val.name}</option>`);
                    $('#pen1country').append(`<option selected value="${val.name}">${val.name}</option>`);
                    $('#pen2country').append(`<option selected value="${val.name}">${val.name}</option>`);
                    $('#pen3country').append(`<option selected value="${val.name}">${val.name}</option>`);
                }
                else {
                    $('#country').append(`<option value="${val.name}">${val.name}</option>`);
                    $('#pen1country').append(`<option value="${val.name}">${val.name}</option>`);
                    $('#pen2country').append(`<option value="${val.name}">${val.name}</option>`);
                    $('#pen3country').append(`<option value="${val.name}">${val.name}</option>`);
                }
            })
        })
    </script>
    <script src="{{ asset('vendor/select2/select2.min.js') }}"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- <script>
        $(function(){
            $('#picture').change(function(e){
                let blob = URL.createObjectURL(e.target.files[0]);
                $('#profile_view').attr('src', blob);
            })
        })
    </script> --}}
    <script>
        $(function(){
            // $('.form-control, .custom-select, input').prop('disabled', true);
            $.fn.select2.defaults.set( "theme", "bootstrap" );
            $('#country').select2({width:'100%'});
            $('#pen1country').select2({width:'100%'});
            $('#pen2country').select2({width:'100%'});
            $('#pen3country').select2({width:'100%'});
            // $('#aan').prop('disabled', false);
            $('#register_btn').prop('disabled', true);

            $('#ck_box1,#ck_box2, #ck_box3, #ck_box4, #ck_box5').change(function(){
                if($('#ck_box1').prop('checked') == true && $('#ck_box2').prop('checked') == true && $('#ck_box3').prop('checked') == true && $('#ck_box4').prop('checked') == true && $('#ck_box5').prop('checked') == true){
                    $('#register_btn').prop('disabled', false);
                }else {
                    $('#register_btn').prop('disabled', true);
                }
            });

            var college = $('.college');
            var is = $('.is');
            var berk = $('.berkeley');
            var reag = $('.reagan');
            var integ = $('.integ');
            berk.detach();
            reag.detach();
            college.detach();
            $('#college').change(function(){
                if($(this).val() == "Integrated School"){
                    college.detach();
                    berk.detach();
                    reag.detach();
                    $(integ).appendTo('#courses');
                    $(is).appendTo($('#club'));
                }else {
                    is.detach();
                    $(integ).detach();
                    if($(this).val() == 'Reagan Arts And Humanities'){
                        $(reag).appendTo('#courses');
                        $(berk).detach();
                    }else {
                        $(berk).appendTo('#courses');
                        $(reag).detach();
                    }
                    $(college).appendTo($('#club'));
                }
            });

            

            $('.selectme').select2();
            // $('#aan').change(function(){
            //     $.post('{{ route("aan.check") }}', {aan:$('#aan').val()}, function(data,res){
            //         if(data == 1){
            //             $('#aan').removeClass('is-invalid')
            //             $('#aan').addClass('is-valid');
            //             $('.form-control, .custom-select, input').prop('disabled', false);
            //             $('#aan').prop('disabled', false);
            //             $('.text-helper').html('<span class="text-success">You\'re good to go!</span>');
            //         }else {
            //             $('#aan').removeClass('is-valid')
            //             $('.form-control,.btn, .custom-select, input').prop('disabled', true);
            //             $('#aan').prop('disabled', false);
            //             $('#aan').addClass('is-invalid')
            //             $('.text-helper').html('<span class="text-danger">Invalid AAN</span>');
            //         }
            //     })
            // });
        })
    </script>
    <script>
        // Add the following code if you want the name of the file appear on select
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    </script>

    <script>
        $(function(){
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

            $('#pen2').keyup(function(e){
                $.post('{{ route("pen.check") }}', {name:$(this).val()}, function(data, res){
                    $('#pen2').removeClass('is-invalid');
                    $('#pen2').removeClass('is-valid');
                    $('#pen2').addClass(data.inputclass);
                    $('#pen2-alert').removeClass('alert alert-danger');
                    $('#pen2-alert').removeClass('alert alert-success');
                    $('#pen2-alert').addClass('alert py-1 '+data.alertclass);
                    $('#pen2-alert').text(data.msg);
                })
                
            });

            $('#pen3').keyup(function(e){
                $.post('{{ route("pen.check") }}', {name:$(this).val()}, function(data, res){
                    $('#pen3').removeClass('is-invalid');
                    $('#pen3').removeClass('is-valid');
                    $('#pen3').addClass(data.inputclass);
                    $('#pen3-alert').removeClass('alert alert-danger');
                    $('#pen3-alert').removeClass('alert alert-success');
                    $('#pen3-alert').addClass('alert py-1 '+data.alertclass);
                    $('#pen3-alert').text(data.msg);
                })
                
            });
        })
    </script>
    <script>
        $(function(){
            $('#email').change(function(){
                $.post('{{ route("email.check") }}', {email:$(this).val()}, function(data, res){
                    $('#email').removeClass('is-invalid');
                    $('#email').removeClass('is-valid');
                    $('#email').addClass(data.inputclass);
                    $('#emailAlert').removeClass('alert alert-danger');
                    $('#emailAlert').removeClass('alert alert-success');
                    $('#emailAlert').addClass('alert py-1 '+data.alertclass);
                    $('#emailAlert').text(data.msg);
                })
            });

            function calculate_age(dob) { 
                var diff_ms = Date.now() - dob.getTime();
                var age_dt = new Date(diff_ms); 
            
                return Math.abs(age_dt.getUTCFullYear() - 1970);
            }
            
            $('#bdate').change(function(){
                let date = $(this).val();
                let arr_date = date.split('-');
                let age = calculate_age(new Date(arr_date[2],arr_date[1],arr_date[0]));

                if(age < 15){
                    alert('You must be 15 years old and above to register and use this site.');
                    $('#bdate').val('');
                }
            })
            
        })
    </script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.12/dist/vue.js"></script>
    <script>
        new Vue({
            data:{
                fpassword:'',
                spassword:''
            },
            methods:{
                passwordMatch(){
                    return this.fpassword != this.spassword;
                }
            }
        }).$mount('#password-app');
    </script>
@endsection
