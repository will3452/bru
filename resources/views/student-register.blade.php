<x-static.html>
    <style>
        .form-group{
            margin: 10px;
            text-align: left;
            width: 100%;
        }
        .form-group > input{
            width: 99%;
        }
        .form-group > select{
            width: 100%;
        }
        label{
            display: block;
        }
        form {
            height: 100%;
        }
    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <x-static.section>
        <div class="container">
            @if (session('error'))
                <div>
                    {{ session('error') }}
                </div>
            @endif
            <form action="/pre-register" method="POST">
                @csrf
                    <x-form.group>
                        <h2>PRE-REGISTER</h2>
                    </x-form.group>
                    <x-form.group>
                        <x-form.input type="text" label="First Name" name="first_name" required/>
                    </x-form.group>
                <x-form.group>
                    <x-form.input type="text" label="Last Name" name="last_name" required/>
                </x-form.group> 
                <x-form.group>
                    <x-form.select
                    label="Gender"
                    name="gender"
                    :options="[
                        [
                            'label'=>'male',
                            'value'=>'male',
                        ],
                        [
                            'label'=>'female',
                            'value'=>'female',
                        ]
                    ]" required/>
                </x-form.group>
                <x-form.group>
                    <x-form.select
                    label="Sex"
                    name="sex"
                    :options="[
                        [
                            'label'=>'male',
                            'value'=>'male',
                        ],
                        [
                            'label'=>'female',
                            'value'=>'female',
                        ]
                    ]" required/>
                </x-form.group>
                <x-form.group>
                    <x-form.input type="text" label="Email" name="email" required/>
                </x-form.group>
                <x-form.group>
                    <x-form.input type="password" label="Password" name="password" required/>
                </x-form.group>
                <x-form.group>
                    <x-form.input type="date" label="Birthdate" name="birthdate" />
                </x-form.group>
                <x-form.group>
                        <x-form.input type="text" label="City" name="city" required/>
                </x-form.group>
                <x-form.group>
                    <label for="">Country</label>
                    <select name="country" id="country"></select>
                </x-form.group>
                <x-form.group>
                    <label for="#">BRU College</label>
                    <select name="interest[]" class="form-control w-100 selectme" id="college" >
                        <option value="Integrated School">Integrated School</option>
                        <option value="Berkeley Business And Sciences">Berkeley Business And Sciences</option>
                        <option value="Reagan Arts And Humanities">Reagan Arts And Humanities</option>
                    <select>
                </x-form.group>
                <x-form.group>
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
                </x-form.group>
                <x-form.group>
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
                </x-form.group>
                <x-form.group>
                    <button>Register</button>
                </x-form.group>
                <script src="/js/countries.js"></script>
                <script>
                    let country = document.getElementById('country');

                    for(let c of countries){
                        
                        country.innerHTML += `<option name="${c.name}">${c.name}</option>`;
                    }
                </script>

                <script>
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
                </script>
                </form>
        </div>
    </x-static.section>
</x-static.html>