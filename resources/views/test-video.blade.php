<head>
  <link href="https://vjs.zencdn.net/7.14.3/video-js.css" rel="stylesheet" />

  <!-- If you'd like to support IE8 (for Video.js versions prior to v7) -->
  <!-- <script src="https://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script> -->
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

  <script src="https://vjs.zencdn.net/7.14.3/video.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/videojs-landscape-fullscreen@11.22.0/dist/videojs-landscape-fullscreen.min.js" integrity="sha256-CaEdWZGTx1gzx+jxTVAl25E+V8uHqD9trrOHTFmxVTY=" crossorigin="anonymous"></script>

</body>