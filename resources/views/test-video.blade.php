<html>
  <head>
  <link rel="stylesheet" href="/js/video-js.min.css">
  <link rel="stylesheet" href="/js/videojs-rotate-player-plugin.css">
<meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
  <style>
    body, html{
      margin: 0px;
      padding:0px;
      overflow: hidden;
    }
  </style>
</head>

<body>
  <video
    id="my-video"
    class="video-js vjs-big-play-centered vjs-fill"
    controls
    preload="auto"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
  >
    <source src="{{  $src }}" type="video/mp4" />
    <source src="{{ $src }}"type="video/webm" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>

  <script src="/js/video.min.js"></script>
  <script src="/js/videojs-rotate-player-plugin.js"></script>
  {{-- <script src="/js/videojs-landscape-fullscreen.min.js"></script> --}}

  <script>
    var player = videojs('my-video');
    // player.aspectRatio('16:9');
    // player.enterFullWindow()
    player.rotatePlayerPlugin();
    // player.landscapeFullscreen();
  </script>
</body>
</html>