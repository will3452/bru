<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>BRUMULTIVERSE</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />
<style>
    #pp{
        position: fixed;
        
        top:100px;
        text-align: center;
        color: white;
        border-radius: 0px;
        padding:20px;
        display:flex;
        align-items: center;
        flex-direction: column;
        justify-content: center;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/js-cookie@rc/dist/js.cookie.min.js"></script>
</head>
<body>
    <div id="pp">
        <div class="row">
            <div class="col-md-4"></div>
            <div class="col-md-4 p-4 " style="background:url('/img/card-bg-custom.png');
            background-size: cover;">
                <div>
                    Kindly take time to read our <a href="#">Privacy Policy</a>. By continuiong to browse this site and/or clicking "I AGREE". You guarantee that you have read and understand our Privacy Policy and consent to its terms.
                </div>
                <button class="btn btn-primary mt-5" onclick="ppAgree()">I AGREE</button>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background:#16142E">
        <a class="navbar-brand" href="#">BRUMULTIVERSE</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">About Us<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Contact Us</a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="/please-input-aan"> <i class="fa fa-user-plus"></i> Sign Up<span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/login"> <i class="fa fa-sign-in-alt"></i> Sign In</a>
                </li>
            </ul>
        </div>
    </nav>
    
    <div class="container">
        
    </div>
    
    <footer class="text-white bg-dark pt-5" style="background:#040206 !important">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <p>We’d love for you to join our growing BRU family!</p>
                    <h3>BRUMULTIVERSE</h3>
                    Immerse yourself, experience and be part of each university story on e-books, audio books, short videos and songs from authors and artists around the globe!
                </div>
                <div class="col-md-3 d-flex flex-column align-items-center">
                    <h5>Download our App!</h5>
                    <div class="mb-2">
                        <a href="#">
                            <img src="/googleplay.png" alt="" class="img-fluid d-block" style="height:50px;">
                        </a>
                    </div>
                    <div>
                        <a href="#">
                            <img src="/appstore.png" alt="" class="img-fluid d-block" style="height:50px;">
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul style="list-style-type: none; padding:0px;">
                        <li>
                            <a href="/"><i class="fa fa-link mr-2"></i>Home</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-link mr-2"></i>About Us</a>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-link mr-2"></i>Contact Us</a>
                        </li>
                        <li>
                            <a href="/please-input-aan"><i class="fa fa-link mr-2"></i>Sign In</a>
                        </li>
                        <li>
                            <a href="/login"><i class="fa fa-link mr-2"></i>Login</a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
    </footer>
    <div class="row justify-content-center text-white" style="background:#000 !important">
        <small>
            Copyright BRUMULTIVERSE 2020. Tarlac City, Philippines.
        </small>
    </div>
    
</body>
</html>