<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name') ?? 'BRUMULTIVERSE' }}</title>
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body{
            overflow-x: hidden;
        }
        #header{
            width: 100vw;
            height: 199px;
            background: url('images/background_2.webp');
            background-size: cover;
            box-sizing: border-box;
        }
        #header-footer{
            background: url('images/background_for_text.png');
            width: 99vw;
            height: 69px;
            position: absolute;
            top: 130px;
            box-sizing: border-box;
        }
        #app-logo{
            background: url('images/2-layers\ \(1\).png');
            width: 166px;
            height: 167px;
            background-size: contain;
            position: absolute;
            z-index: 99;
        }
        #app-logo-text{
            width: 477px;
        }
        #ber {
            background-image: url('images/berk (1).png');
            width: 257px;
            height: 26px;
            cursor: pointer;
            
        }
        #about{
            background-image: url('images/about (1).png');
            width: 97px;
            height: 17px;
            cursor: pointer;

        }
        #contact{
            background-image: url('images/contact (1).png');
            width: 98px;
            height: 18px;
            cursor: pointer;

        }
        #signup{
            background-image: url('images/sign up (1).png');
            width: 130px;
            height: 26px;
            cursor: pointer;

        }
        #signin {
            background: url('images/sign\ in.png');
            width:143px;
            height: 40px;
            cursor: pointer;

        }
        .color-me {
            color: #AB983F !important;
        }
        #art {
            background:url(@yield('art', '/images/front.jpg'));
            background-size:contain;
            height: 550px;
            /* background-attachment: fixed; */
            background-repeat:no-repeat;
            background-position:center top;
        }
    </style>
    <script>
        let adminLinkCounter = 1;
        function gotoAdmin(){
            if(adminLinkCounter == 3){
                window.location.href = '/admin/login';
            }
            adminLinkCounter++;
        }
    </script>
</head>
<body class="text-gray-900 font-serif bg-gray-100" style="">
    @if (isset(request()->back) && request()->back == true)
    <a href="{{ url()->previous() }}" style="z-index:999" class="block fixed h-16 bg-purple-900 text-6xl text-center hover:text-white w-full">BACK</a>
    @endif
    <div id="header" class="h-4 m-auto hidden md:block">
        <div id="app-logo" onclick="gotoAdmin()"></div>
        <div class="flex justify-center pt-2">
            <img id="app-logo-text"  onclick="gotoAdmin()" src="images/2-layers (2).png" alt="">
        </div>
        <div id="header-footer" class="flex items-center justify-end">
            <div id="ber" class="mx-2"></div>
            <div id="about" class="mx-2"></div>
            <div id="contact" class="mx-2"></div>
            <div id="signup" class="mt-2 mx-2"></div>
            <div id="signin"></div>
        </div>
    </div>
    <div class="bg-black w-screen md:hidden">
        <div class="flex justify-between px-2 items-center">
            <img src="/images/2-layers (1).png" alt="" class="w-16 h-16">
            <button class="pr-2" id="menu-toggler">
                <i class="fa fa-bars fa-2x text-purple-100"></i>
            </button>
        </div>
        <div class="bg-black text-white hidden" id="menu-list">
            <ul class="text-center">
                <li class="py-1 hover:bg-purple-900 color-me"><a href="/">Berkeley Reagan Univerisity</a></li>
                <li class="py-1 hover:bg-purple-900 color-me"><a href="#">About Us</a></li>
                <li class="py-1 hover:bg-purple-900 color-me"><a href="#">Contact Us</a></li>
                <li class="py-1 hover:bg-purple-900 color-me"><a href="/please-input-aan">Sign Up</a></li>
                <li class="py-1 text-2xl hover:bg-purple-900 color-me"><a href="/login">Sign In</a></li>
            </ul>
        </div>
    </div>
    <div id="art" class="w-full">
    </div>
    <div class=" mx-auto w-10/12">
        
        @yield('content')
        <hr>
        <footer class="flex flex-col items-center mt-5 justify-center">
            <p>We’d love for you to join our growing BRU family!</p>
            <img src="/images/2-layers (2).png" alt="" class="w-4/12">
            <p class="text-center w-8/12">
                Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
            </p>
            <div class="flex justify-center mt-2">
                <img src="/images/googleplay.png" alt="" class="w-3/12 mx-2">
                <img src="/images/appstore.png" alt="" class="w-3/12 mx-2">
            </div>
            <div class="text-center text-sm mt-3">
                Copyright BRUMULTIVERSE 2020. Tarlac City, Philippines.
            </div>
        </footer>
    </div>
    <script>
        window.onload = function(){
            

            let show = false;
            let menuList = document.getElementById('menu-list');
            document.getElementById('menu-toggler').onclick = function(){
                if(!show){
                    menuList.classList.remove('hidden');
                }else {
                    menuList.classList.add('hidden');
                }
                show = !show;
            }



             // 
             document.getElementById('ber').onclick = function(){
                window.location.href="/";
             }

             document.getElementById('about').onclick = function(){
                window.location.href="/about";
             }

             document.getElementById('contact').onclick = function(){
                window.location.href="/contact";
             }

             document.getElementById('signup').onclick = function(){
                 window.location.href="/please-input-aan";
             }

             document.getElementById('signin').onclick = function(){
                window.location.href="/login";
             }
             
            
        }

        
    </script>
</body>
</html>