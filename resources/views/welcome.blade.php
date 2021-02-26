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
        #header{
            width: 1024px;
            height: 199px;
            background: url('images/background_2.webp');
            background-size: cover;
        }
        #header-footer{
            background: url('images/background_for_text.png');
            width: 1024px;
            height: 69px;
            position: absolute;
            top: 130px;
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
            background-image: url('images/berk.png');
            width: 256px;
            height: 29px;
            cursor: pointer;
        }
        #about{
            background-image: url('images/about.png');
            width: 97px;
            height: 17px;
            cursor: pointer;

        }
        #contact{
            background-image: url('images/contact.png');
            width: 98px;
            height: 18px;
            cursor: pointer;

        }
        #signup{
            background-image: url('images/sign up.png');
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
            background:url('images/dan-cristian-padure-NNqTuz826lg-unsplash.jpg');
            background-size: cover;
            height: 50vh;
            background-attachment: fixed;
        }
    </style>
</head>
<body class="text-gray-900 font-serif bg-gray-100" style="max-width:1024px;margin: auto;">
    <div id="header" class="h-4 m-auto hidden md:block">
        <div id="app-logo"></div>
        <div class="flex justify-center pt-2">
            <img id="app-logo-text"  src="images/2-layers (2).png" alt="">
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
                <li class="py-1 hover:bg-purple-900 color-me"><a href="#">Berkeley Reagan Univerisity</a></li>
                <li class="py-1 hover:bg-purple-900 color-me"><a href="#">About Us</a></li>
                <li class="py-1 hover:bg-purple-900 color-me"><a href="#">Contact Us</a></li>
                <li class="py-1 hover:bg-purple-900 color-me"><a href="/please-input-aan">Sign Up</a></li>
                <li class="py-1 text-2xl hover:bg-purple-900 color-me"><a href="/login">Sign In</a></li>
            </ul>
        </div>
    </div>
    <div class="w-full mx-auto">
        <div id="art" class="w-full">
        </div>
        <div>
            <p class="text-2xl mt-2">
                Berkeley-Reagan University or BRU was founded on October 13 by a British teacher, named Henry Berkeley, and an American businessman, named William Reagan, who came to Taguig City, Philippines in 1951.
            </p>
            <p class="text-2xl mt-4">
                From offering only four courses in natural sciences and performing arts as Berkeley-Reagan Colleges, it has expanded, not only its land area, but also the curriculum it offered over the years. It earned its University status in 1986, as more than eight thousand students from around Southeast Asia flocked its grounds, making it one of the most prestigious international universities in the world. In 1989, BRU began accepting students from Pre-K to Senior High, which now comprises its Integrated School population.
            </p>
            <p class="text-2xl mt-4">
                At present, BRU specializes in Business, Sports, Arts and Social Sciences. Its British-American-inspired buildings withstood the test of time, boasting their original architectural designs and structures to date, along with state-of-the art facilities.
            </p>
        </div>
        <div class="mt-5">
            <h2 class="text-4xl font-bold">VISION / MISSION</h2>
            <p class="text-2lg">
                Berkeley-Reagan University is a premier university in business, arts and sciences that bridges knowledge and culture and develops globally-competitive and responsible professionals attuned to a sustainable world.
            </p>
        </div>
        <div class="flex mt-5 flex-col md:flex-row">
            <div class="w-full md:w-1/2">
                <h2 class="text-4xl font-bold">GOALS</h2>
                <ol class="text-2lg">
                    <li class="mt-2">
                       1.  Provide quality education through highly trained and competent educators and state-of-the-arts facilities.
                    </li>
                    <li class="mt-2">
                       2.  Challenge the abilities of young individuals to promote resourcefulness and creativity through various activities inside and/or outside the campus.
                    </li>
                    <li class="mt-2">
                       3.  Develop critical minds of students in addressing important issues and guide them into making sound judgment.
                    </li>
                    <li class="mt-2">
                       4. Promote openness, mutual respect and collaboration in a multi-cultural and multi-racial environment.
                    </li>
                    <li class="mt-2">
                        5. Maintain and preserve ecological balance through initiatives directed towards caring for Mother Earth.
                    </li>
                </ol>
            </div>
            <div class="pl-4 w-full md:w-1/2">
                <h2 class="text-4xl font-bold">CORE VALUES</h2>
                <ol class="text-2lg">
                    <li class="mt-2">
                        <i class="fa fa-check"></i>   Excellence and Competence.
                    </li>
                    <li class="mt-2">
                        <i class="fa fa-check"></i> Imagination and Creativity.
                    </li>
                    <li class="mt-2">
                        <i class="fa fa-check"></i> Respect and Compassion.
                    </li>
                    <li class="mt-2">
                        <i class="fa fa-check"></i> Community and Culture.
                    </li>
                    <li class="mt-2">
                        <i class="fa fa-check"></i> Honor and Integrity.
                    </li>
                </ol>
            </div>
        </div>
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
                window.location.href="/bru";
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