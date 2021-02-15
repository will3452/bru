<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <meta name="title" content="BRUMULTIVERSE">
  <meta name="description" content="Provide quality education through highly trained and competent educators and state-of-the-arts facilities.		">
  <meta name="keywords" content="educator, ebook, online, horror, bru, university, school, universe, books, audio books, art, artscene, events, event book, games">
  <meta name="robots" content="index, follow">
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <meta name="language" content="English">
  <meta name="revisit-after" content=" days">
  <meta name="author" content="BRUMULTIVERSE">
  <meta property="og:title" content="BRUMULTIVERSE">
  <meta property="og:description" content="Provide quality education through highly trained and competent educators and state-of-the-arts facilities.">
  <meta property="og:image" content="{{ asset('img/textlogo.png') }}">
  <meta property="og:url" content="{{ route('login') }}">
  <title>{{ config('app.name') }}</title>
  <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{ asset('/css/app.css') }}">
  <style>
    body{
      background: #D5D9E7;
    }
    * {
      padding: 0px;
      margin: 0px;
      box-sizing: border-box;
      font-family: 'Times New Roman', Times, serif;
    }
    #logo{
      max-width: 250px;
      transform: translate(-2em);
      
    }
    .flexme{
      display: flex;
    }
    .flexbetween{
      justify-content: space-between;
      align-items: center;
    }
    #top {
      background: url('{{ asset('img/signbackground.png') }}');
      background-size:cover;
    }
    #header {
      width: 100vw;
      padding: 10px 10px;
    }
    #toggler{
      background: #322F46;
      padding: 0.5em;
      border:none;
      width: 50px;
      height: 50px;
      font-size: 1.5em;
      color: #fff;
      border-radius: 50%;
    }
    .menu {
      width: 100%;
      background: #23023D;
      padding: 0px !important;
      list-style: none;
      /* background: #000; */
      /* text-align: center; */
    }
    .menu-item {
      display: block;
      padding:10px 1em;
      width: 100%;
    }
    .menu-item a{
      text-decoration: none;
      color: white;
      font-size: 1.25em;
    }
    .menu-item:hover{
      background: rgba(0, 0, 0, 0.5);
    }
    #large {
      display: none;
    }
    main{
      text-justify: center;
    }
    #map {
      position: relative;
      overflow: auto;
      height:100%;
      /* border:0.5em solid #AA973E; */
    }
    #footer{
      position: relative;
    }
    @media screen and (min-width:1025px){
      #download {
        width:50vw;
        margin: auto;
      }
      #download img{
        width: 100%;
      }
      main {
        position:relative;
        top:-10vh;
      }

      #small{
        display: none;
      }
      #large {
        display: block;
      }
      #l-header{
        height: 35vh;
        background: #000;
      }
      #l-header-bg{
        height: 20vh;
        background: url('{{ asset('img/signbackground.png') }}')
      }
      #l-logo{
        max-width: 12vw;
        position: absolute;
        top: 2.5vh;
        left: 7vw;
        z-index: 999;
        border-radius: 50%;
        box-shadow: 0px 0px 20px 10px #6C2EB1;
        border:1px solid white;
      }
      #l-textlogo{
        max-width: 40vw;
        position: absolute;
        top: 2.5vh;
        left:30vw;
      }

      #l-link-container{
        height: 15vh;
        background: url('{{ asset('img/linkbackground.png') }}');
        position: relative;
        top: -15vh;
        z-index: 998;
        background-size: 100vw 15vh;
        display: flex;
        justify-content:flex-end;
        align-items: center;
      }
      #l-link-container>a{
        margin: 1vw;
        font-size: 1.5em;
        padding: 0px 1em;
        text-decoration: none;
        color: #C5BA86;
        background-repeat: no-repeat;
        height: 50%;
        text-align: center;
      }
      #signin{
        font-size: 1.7em;
      }
    
     /* .arrow1{
        background: url('{{ asset('img/arrowhead.png') }}');
        background-size:contain;
        background-position:left bottom;
        height:54% !important;
     }
     .arrow2{
        background: url('{{ asset('img/arrowbody.png') }}');
        background-size:contain;
        background-position:left bottom;
     }

     .arrow3{
        background: url('{{ asset('img/arrowtail.png') }}');
        background-size:contain;
        background-position:left bottom;
        height: 45% !important;

     }
     .arrow4{
        background: url('{{ asset('img/arrowfull.png') }}');
        background-size:contain;
        background-position:left top;
        height:10vh;
        position:relative;
        top:-3vh;
        width:12vw;
        background-repeat:no-repeat;
     } */
     /* .arrow4{
        background: url('{{ asset('img/arrowfull.png') }}');
        background-size:contain;
        background-position:left top;
        height:10vh;
        position:relative;
        top:-2vh;
        width:12vw;
        background-repeat:no-repeat;
     } */

    }
    @media screen and (min-width:1400px){
      /* .arrow1, .arrow2, .arrow3, .arrow4{
        background: none;
        
      }
      .arrow1>div, .arrow2>div, .arrow3>div, .arrow4>div{
        text-decoration-color: #C5BA86;
        text-decoration:underline;
      } */
    }
  </style>
</head>
<body >
  <div id="small">
    <div id="top">
      <div id="header">
        <div class="flexme flexbetween">
          <a href="#">
            <img src="{{ asset('img/textlogo.png') }}" id="logo" alt="">
          </a>
          <button id="toggler">
            <i class="fa fa-bars"></i>
          </button>
        </div>
      </div>
    </div>
    <ul class="menu">
      <li class="menu-item">
        <a href="#">Berkeley-Reagan University</a>
      </li>
      <li class="menu-item">
        <a href="#">About us</a>
      </li>
      <li class="menu-item">
        <a href="#">Contact us</a>
      </li>
      <li class="menu-item">
        <a href="{{ route('input.aan') }}">Sign Up</a>
      </li>
      <li class="menu-item">
        <a href="{{ route('login') }}">Sign In</a>
      </li>
    </ul>
  </div>
  <div id="large">
    <div id="l-header">
      <div id="l-header-bg"></div>
      <img src="{{ asset('img/logo.png') }}" alt="" id="l-logo">
      <img src="{{ asset('img/textlogo.png') }}" alt="" id="l-textlogo">
    </div>
    <div id="l-link-container">
      <a href="" class="arrow1">
        <div>Berkeley-Reagan University</div>
      </a>
      <a href="" class="arrow2">
        <div>About Us</div>
      </a>
      <a href="" class="arrow2">
        <div>Contact Us</div>
      </a>
      <a href="{{ route('input.aan') }}" class="arrow3">
        <div>Sign Up</div>
      </a>
      <a href="{{ route('login') }}">
        <div id="signin">Sign In</div>
        <div class="arrow4"></div>
      </a>
    </div>
  </div>
  <main class="container">
    <div class="row mt-2 mt-md-0">
      <div class="col">
        <img src="{{ asset('img/map.png') }}"  class="img-fluid border" alt="">
      </div>
    </div>

    <div class="mt-3 text-justify">
      <p>
        Berkeley-Reagan University or BRU was founded on October 13 by a British teacher, named Henry Berkeley, and an American businessman, named William Reagan, who came to Taguig City, Philippines in 1951. 
      </p>
      <p>
        From offering only four courses in natural sciences and performing arts as Berkeley-Reagan Colleges, it has expanded, not only its land area, but also the curriculum it offered over the years. It earned its University status in 1986, as more than eight thousand students from around Southeast Asia flocked its grounds, making it one of the most prestigious international universities in the world. In 1989, BRU began accepting students from Pre-K to Senior High, which now comprises its Integrated School population.
      </p>
      <p>
        At present, BRU specializes in Business, Sports, Arts and Social Sciences. Its British-American-inspired buildings withstood the test of time, boasting their original architectural designs and structures to date, along with state-of-the art facilities.
      </p>
    </div>
    <hr>
    <div class="mt-2">
      <h2 class="text-center text-md-left">VISION - MISSION</h2>
      <p class="text-justify">
        Berkeley-Reagan University is a premier university in business, arts and sciences that bridges knowledge and culture and develops globally-competitive and responsible professionals attuned to a sustainable world.
      </p>
    </div>
    <hr>
    <div class="row mt-2">
      <div class="col-md-6">
        <h2 class="text-center text-md-left">GOALS</h2>
        <ol class="list-unstyled">
          <li class=" -item">
            <span class="badge badge-primary badge-lg">1</span> Provide quality education through highly trained and competent educators and state-of-the-arts facilities.		
          </li>
          <li class=" -item">
            <span class="badge badge-primary badge-lg">2</span> Challenge the abilities of young individuals to promote resourcefulness and creativity through various activities inside and/or outside the campus.	
          </li>
          <li class=" -item">
            <span class="badge badge-primary badge-lg">3</span> Develop critical minds of students in addressing important issues and guide them into making sound judgment.			
          </li>
          <li class=" -item">
            <span class="badge badge-primary badge-lg">4</span> Promote openness, mutual respect and collaboration in a multi-cultural and multi-racial environment.		
          </li>
          <li class=" -item">
            <span class="badge badge-primary badge-lg">5</span> Maintain and preserve ecological balance through initiatives directed towards caring for Mother Earth.	
          </li>
        </ol>
      </div>
      <div class="col-md-6">
        <h2 class="text-center text-md-left">
          CORE VALUES
        </h2>
        <ul class="list-unstyled">
          <li class=" -item">
            <i class="fa fa-check text-success"></i>
            Excellence and Competence		
          </li>
          <li class=" -item">
            <i class="fa fa-check text-success"></i>
            Imagination and Creativity		
          </li>
          <li class=" -item">
            <i class="fa fa-check text-success"></i>
            Respect and Compassion	
          </li>
          <li class=" -item">
            <i class="fa fa-check text-success"></i>
            Community and Culture				
          </li>
          <li class=" -item">
            <i class="fa fa-check text-success"></i>
            Honor and Integrity					
          </li>
        </ul>
      </div>
    </div>
  </main>
  <footer style="background:#020102" class=" p-2">
    <div>
      <p class="lead text-white text-center">
        We’d love for you to join our growing BRU family!
      </p>
      <div class="row justify-content-center">
        <div class="col-md-4 col-6">
          <img src="{{ asset('img/textlogo.png') }}" class="img-fluid" alt="">
        </div>
      </div>
    </div>
    <div class="mt-2">
      <div class="row justify-content-center">
         <div class="col-md-4">
          <p class="text-white text-center lead">
            Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe! 
          </p>
         </div>
      </div>
    </div>
    <div class="d-flex justify-content-center">
      <div style="max-width: 200px" class="mx-1">
        <a href="#">
          <img src="{{ asset('img/welcome/googleplay.png') }}" class="img-fluid" alt="">
        </a>
      </div>
      <div style="max-width: 200px" class="mx-1">
        <a href="#">
          <img src="{{ asset('img/welcome/appstore.png') }}" class="img-fluid" alt="">
        </a>
      </div>
    </div>
    <small class="text-center d-block mt-3 text-white">
      Copyright BRUMULTIVERSE 2020. Tarlac City, Philippines. 
    </small>
  </footer>

  <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script>

  <script>
    $(function(){
      $('.menu').hide();
      $('#toggler').click(function(){
        $('.menu').slideToggle(500);
      })
    })
  </script>
</body>
</html>