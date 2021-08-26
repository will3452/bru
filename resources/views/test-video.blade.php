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
        
    </style>
    <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />
</head>
<body>
    <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    style="width:100vw; height:100vh;" 
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
  >
    <source src="{{ $src }}" type="video/mp4" />
    <source src="{{ $src }}" type="video/webm" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>
  <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
</body>
</html>