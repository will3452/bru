<head>
  <link rel="stylesheet" href="/js/video-js.min.css">
  <link rel="stylesheet" href="/js/videojs-rotate-player-plugin.css">

  <style>
    body, html{
      margin: 0px;
      padding:0px;
      
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

    console.log('zoomrotate: Start');

(function(){
    var defaults, extend;
    console.log('zoomrotate: Init defaults');
    defaults = {
      zoom: 1,
      rotate: 0,
      debug: true
    };
    extend = function() {
      var args, target, i, object, property;
      args = Array.prototype.slice.call(arguments);
      target = args.shift() || {};
      for (i in args) {
        object = args[i];
        for (property in object) {
          if (object.hasOwnProperty(property)) {
            if (typeof object[property] === 'object') {
              target[property] = extend(target[property], object[property]);
            } else {
              target[property] = object[property];
            }
          }
        }
      }
      return target;
    };

  /**
    * register the zoomrotate plugin
    */
    videojs.plugin('zoomrotate', function(settings){
        if (defaults.debug) console.log('zoomrotate: Register init');

        var options, player, video, poster;
        options = extend(defaults, settings);

        /* Grab the necessary DOM elements */
        player = this.el();
        video = this.el().getElementsByTagName('video')[0];
        poster = this.el().getElementsByTagName('div')[1]; // div vjs-poster

        if (options.debug) console.log('zoomrotate: '+video.style);
        if (options.debug) console.log('zoomrotate: '+poster.style);
        if (options.debug) console.log('zoomrotate: '+options.rotate);
        if (options.debug) console.log('zoomrotate: '+options.zoom);

        /* Array of possible browser specific settings for transformation */
        var properties = ['transform', 'WebkitTransform', 'MozTransform',
                          'msTransform', 'OTransform'],
            prop = properties[0];

        /* Iterators */
        var i,j;

        /* Find out which CSS transform the browser supports */
        for(i=0,j=properties.length;i<j;i++){
          if(typeof player.style[properties[i]] !== 'undefined'){
            prop = properties[i];
            break;
          }
        }

        /* Let's do it */
        player.style.overflow = 'hidden';
        video.style[prop]='scale('+options.zoom+') rotate('+options.rotate+'deg)';
        poster.style[prop]='scale('+options.zoom+') rotate('+options.rotate+'deg)';
        if (options.debug) console.log('zoomrotate: Register end');
    });
})();

console.log('zoomrotate: End');
  </script>

  <script>
    var player = videojs('my-video');
    // player.enterFullWindow()
    player.rotatePlayerPlugin();
    // player.landscapeFullscreen();
  </script>
</body>