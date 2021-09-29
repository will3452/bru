<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <title>BRUMULTIVERSE | PRE-REGISTER</title>
</head>
<body>
<img src="/banner/pre-register.jpg" alt="" class="object-fit mx-auto">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<div class="w-full md:w-3/5 mx-auto px-2">
    <div class="text-center p-4 leading-6 text-gray-900">
        <h1 class="text-3xl font-thin mb-4">
            WELCOME TO BRUMULTIVERSE!
        </h1>
        <p class="mb-4 text-gray-700">
            Your interest in the BRU App has led you to this space at this perfect moment.
            What a sweet turn of fate!
        </p>
        <p class="mb-4 text-gray-700">
            BRUMULTIVERSE is a fictional multiple universe with dimensions, realms and
            parallel realities, where amazing stories happen in different forms of art or media.
            Such stories will be accessible in the BRU App that we are launching towards the
            end of 2021.
        </p>
        <p class="mb-4 text-gray-700">
            You may pre-register for an account now so that upon launch, you’re half-way
            into experiencing the multiverse on your mobile phones or tablets. Isn’t that
            amazing?
        </p>
        <p class="mb-4 text-gray-700">
            As a perk, you will receive <b>digital freebies</b> and/or <b>free downloadable</b> contents
            you can use in designing your own BRU Persona. Yes, you will have one, once
            you fully register upon launch! Exciting, isn’t it?
        </p>
        <p class="mb-4 text-gray-700">
            So get right on to the registration below and join our growing community! We’ll
            see you in the multiverse soon!
        </p>
    </div>
    @if (session('error'))
        <div>
            {{ session('error') }}
        </div>
    @endif
    <form action="/pre-register" method="POST">
        @csrf

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">First Name</label>
            <input class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                   type="text"
                   name="first_name"
                   required
                   placeholder="First Name"
            >
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Last Name</label>
            <input class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                   type="text"
                   name="last_name"
                   required
                   placeholder="Last Name"
            >
        </div>
        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Gender</label>
            <select
                class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                name="gender"
                id="gender"
                required
            >
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Sex</label>
            <select
                class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                name="sex"
                id="sex"
                required
            >
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Email</label>
            <input class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                   type="email"
                   name="email"
                   required
                   placeholder="Email"
            >
            @error('email')
            <div class="text-xs text-red-500">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Password</label>
            <input class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                   type="password"
                   name="password"
                   required
                   placeholder="Password"
            >
            @error('password')
            <div class="text-xs text-red-500">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Birthdate</label>
            <input class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                   type="date"
                   name="birthdate"
                   required
            >
            @error('birthdate')
            <div class="text-xs text-red-500">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">City</label>
            <input class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"
                   type="text"
                   name="city"
                   required
                   placeholder="City"
            >
        </div>

        <div class="my-2">
            <label for="" class="block font-bold text-purple-900">Country</label>
            <select name="country" id="country" class="border-2 border-purple-900 rounded-lg p-2 px-4 mt- w-full"></select>
        </div>
        {{--                <x-form.group>--}}
        {{--                    <label for="#">BRU College</label>--}}
        {{--                    <select name="interest[]" class="form-control w-100 selectme" id="college" >--}}
        {{--                        <option value="Integrated School">Integrated School</option>--}}
        {{--                        <option value="Berkeley Business And Sciences">Berkeley Business And Sciences</option>--}}
        {{--                        <option value="Reagan Arts And Humanities">Reagan Arts And Humanities</option>--}}
        {{--                    <select>--}}
        {{--                </x-form.group>--}}
        {{--                <x-form.group>--}}
        {{--                    <label for="#">BRU Course</label>--}}
        {{--                    <select name="interest[]" class="form-control w-100 selectme" id="courses">--}}
        {{--                        <option value="Sports Science" class="berkeley">Sports Science</option>--}}
        {{--                        <option value="Business and Corporate Management" class="berkeley">Business and Corporate Management</option>--}}
        {{--                        <option value="Sports Science" class="berkeley">Sports Science</option>--}}
        {{--                        <option value="Economics" class="berkeley">Economics</option>--}}
        {{--                        <option value="Accountancy" class="berkeley">Accountancy</option>--}}
        {{--                        <option value="Biology" class="berkeley">Biology</option>--}}
        {{--                        <option value="Nursing" class="berkeley">Nursing</option>--}}
        {{--                        <option value="Intellectual Property" class="berkeley">Intellectual Property</option>--}}
        {{--                        <option value="Medicine" class="berkeley">Medicine</option>--}}
        {{--                        <option value="Law" class="berkeley">Law</option>--}}
        {{--                        <option value="Dance" class="reagan">Dance</option>--}}
        {{--                        <option value="Music" class="reagan">Music</option>--}}
        {{--                        <option value="Drama and Theater Arts" class="reagan">Drama and Theater Arts</option>--}}
        {{--                        <option value="Communication Arts (film, photography, film and video, print and broadcast)" class="reagan">Communication Arts (film, photography, film and video, print and broadcast)</option>--}}
        {{--                        <option value="Fine and Studio Arts" class="reagan">Fine and Studio Arts</option>--}}
        {{--                        <option value="Design and Applied Arts" class="reagan">Design and Applied Arts</option>--}}
        {{--                        <option value="History and Literature" class="reagan">History and Literature</option>--}}
        {{--                        <option value="Linguistics" class="reagan">Linguistics</option>--}}
        {{--                        <option value="Literature" class="reagan">Literature</option>--}}
        {{--                        <option value="Foreign Languages" class="reagan">Foreign Languages</option>--}}
        {{--                        <option value="International Studies" class="reagan">International Studies</option>--}}
        {{--                        <option value="Political Science" class="reagan">Political Science</option>--}}
        {{--                        <option value="Psychology" class="reagan">Psychology</option>--}}
        {{--                        <option value="Women's Studies" class="reagan">Women's Studies</option>--}}
        {{--                        <option value="Senior High School" class="integ">Senior High School</option>--}}
        {{--                        <select>--}}
        {{--                </x-form.group>--}}
        {{--                <x-form.group>--}}
        {{--                    <label for="#">BRU Club</label>--}}
        {{--                    <select name="interest[]" class="form-control w-100 selectme" id="club">--}}
        {{--                        <option value="Junior BRAT@sports" class="is">Junior BRAT</option>--}}
        {{--                        <option value="Junior MAC@media arts" class="is">Junior MAC</option>--}}
        {{--                        <option value="Junior PAS@performing arts" class="is">Junior PAS</option>--}}
        {{--                        <option value="Junior Innovators@science" class="is">Junior Innovators</option>--}}
        {{--                        <option value="Junior MATHletes@math" class="is">Junior MATHletes</option>--}}
        {{--                        <option value="Philantrophist@volunteerism" class="is">Philantrophist</option>--}}
        {{--                        <option value="Talakayan@speech and debate" class="is">Talakayan</option>--}}
        {{--                        <option value="Junior Roots@culture and traditions" class="is">Junior Roots</option>--}}
        {{--                        <option value="Senior High Extremes@outdoor and extreme sports" class="is">Senior High Extremes</option>--}}
        {{--                        <option value="Junior Maison@home economics" class="is">Junior Maison</option>--}}
        {{--                        <option value="Junior Entrepreneurs@business" class="is">Junior Entrepreneurs</option>--}}
        {{--                        <option value="Junior Bibliophile@book club" class="is">Junior Bibliophile</option>--}}
        {{--                        <option value="Senior High Voyagers@travel" class="is">Senior High Voyagers</option>--}}
        {{--                        <option value="Junior Green Thumb@plant lovers" class="is">Junior Green Thumb</option>--}}
        {{--                        <option value="Junior Furparents@pet-lovers" class="is">Junior Furparents</option>--}}
        {{--                        <option value="BRU Athletics (BRAT)@sports" class="college">BRU Athletics (BRAT)</option>--}}
        {{--                        <option value="BRU Media Arts Club (BRU MAC)@media arts" class="college">BRU Media Arts Club (BRU MAC)</option>--}}
        {{--                        <option value="BRU Performing Arts Society (BRU PAS)@performing arts" class="college">BRU Performing Arts Society (BRU PAS)</option>--}}
        {{--                        <option value="BRU Innovators@science" class="college">BRU Innovators</option>--}}
        {{--                        <option value="BRU MATHletes@math" class="college">BRU MATHletes</option>--}}
        {{--                        <option value="BRU Social Responsibility Club@volunteerism" class="college">BRU Social Responsibility Club</option>--}}
        {{--                        <option value="BRU Speech and Debate Club@speech and debate" class="college">BRU Speech and Debate Club</option>--}}
        {{--                        <option value="BRU Heritage Club@culture and traditions" class="college">BRU Heritage Club</option>--}}
        {{--                        <option value="BRU Extremes@outdoor and extreme sports" class="college">BRU Extremes</option>--}}
        {{--                        <option value="BRU Maison@home economics" class="college">BRU Maison</option>--}}
        {{--                        <option value="BRU Entrepreneurs@business" class="college">BRU Entrepreneurs</option>--}}
        {{--                        <option value="BRU Bibliophiles@book club" class="college">BRU Bibliophiles</option>--}}
        {{--                        <option value="BRU Voyagers@travel" class="college">BRU Voyagers</option>--}}
        {{--                        <option value="BRU and Green@plant lovers" class="college">BRU and Green</option>--}}
        {{--                        <option value="BRU Furparents@pet-lovers" class="college">BRU Furparents</option>--}}
        {{--                    </select>--}}
        {{--                </x-form.group>--}}
        <div class="my-2">
            <button class="rounded-3xl w-full text-center p-3 uppercase font-bold text-white text-xl bg-gradient-to-r from-blue-900  to-purple-900">Register</button>
        </div>
        <script src="/js/countries.js"></script>
        <script>
            let country = document.getElementById('country')

            for (let c of countries) {

                country.innerHTML += `<option name="${c.name}">${c.name}</option>`
            }
        </script>

        <script>
            var college = $('.college')
            var is = $('.is')
            var berk = $('.berkeley')
            var reag = $('.reagan')
            var integ = $('.integ')
            berk.detach()
            reag.detach()
            college.detach()
            $('#college').change(function () {
                if ($(this).val() == 'Integrated School') {
                    college.detach()
                    berk.detach()
                    reag.detach()
                    $(integ).appendTo('#courses')
                    $(is).appendTo($('#club'))
                } else {
                    is.detach()
                    $(integ).detach()
                    if ($(this).val() == 'Reagan Arts And Humanities') {
                        $(reag).appendTo('#courses')
                        $(berk).detach()
                    } else {
                        $(berk).appendTo('#courses')
                        $(reag).detach()
                    }
                    $(college).appendTo($('#club'))
                }
            })
        </script>
    </form>
</div>
</body>
</html>
