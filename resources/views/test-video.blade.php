<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Hello world</title>
    <style>
        html, body {
            margin: 0px;
            padding: 0px;
            overflow: hidden;
        }
        #fs{
            width: 100vw;
            height: 100vh;
        }
    </style>
</head>
<body>
    <video autoplay="true" controls id="fs" src="https://brumultiverse.com/storage/08-10-211William%20Galasvideoplayback.mp4" >
    </video>
     {{-- <iframe width="420" height="315"
        src="https://www.youtube.com/embed/tgbNymZ7vqY">
        </iframe>  --}}

    <script>
        var elem = document.getElementById("fs");
        if (elem.requestFullscreen) {
        elem.requestFullscreen();
        } else if (elem.mozRequestFullScreen) {
        elem.mozRequestFullScreen();
        } else if (elem.webkitRequestFullscreen) {
        elem.webkitRequestFullscreen();
        } else if (elem.msRequestFullscreen) { 
        elem.msRequestFullscreen();
        }
    </script>
</body>
</html>