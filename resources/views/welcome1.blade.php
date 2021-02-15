<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>{{ config('app.name') }}</title>

  <!-- Bootstrap core CSS -->
  <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  <!-- Custom fonts for this template -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Merriweather:300,300i,400,400i,700,700i,900,900i" rel="stylesheet">
  <link href="/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template -->
  <link href="/css/coming-soon.css" rel="stylesheet">

</head>

<body>
  <div class="position-fixed w-100 text-right py-2 px-2" style="z-index:999999 !important">
    @guest
    <a href="{{ route('input.aan') }}" class="btn btn-outline-primary btn-sm">Sign Up</a>
    <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-sm">Sign In</a>
    @else
    <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm">Go back to Dashboard</a>
    @endguest
  </div>
  <div class="overlay">
    
  </div>
  <video playsinline="playsinline" autoplay="autoplay" muted="muted" loop="loop">
    <source src="mp4/bg.mp4" type="video/mp4">
  </video>

  <div class="masthead">
    <div class="masthead-bg"></div>
    <div class="container h-100">
      <div class="row h-100">
        <div class="col-12 my-auto">
          <div class="masthead-content text-white py-5 py-md-0">
            <h1 class="mb-3">{{ config('app.name') }}</h1>
            <p class="mb-5">Lorem, ipsum dolor sit amet consectetur adipisicing elit. Ut eius porro doloremque nisi cupiditate eaque veritatis accusantium labore error unde?</p>
            <div class="row justify-content-center text-center">
              <div class="col-md-6 mb-2">
                <a href="#">
                  <img src="{{ asset('img/welcome/googleplay.png') }}" class="img-fluid">
                </a>
              </div>
              <div class="col-md-6 mb-2">
                <a href="#">
                  <img src="{{ asset('img/welcome/appstore.png') }}" alt="" class="img-fluid">
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  

  <!-- Bootstrap core JavaScript -->
  <script src="/vendor/jquery/jquery.min.js"></script>
  <script src="/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Custom scripts for this template -->
  <script src="/js/coming-soon.min.js"></script>

</body>

</html>
