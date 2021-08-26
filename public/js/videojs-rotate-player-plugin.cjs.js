/*! @name videojs-rotate-player-plugin @version 1.0.1 @license Apache-2.0 */
'use strict';

function _interopDefault (ex) { return (ex && (typeof ex === 'object') && 'default' in ex) ? ex['default'] : ex; }

var videojs = _interopDefault(require('video.js'));

function _inheritsLoose(subClass, superClass) {
  subClass.prototype = Object.create(superClass.prototype);
  subClass.prototype.constructor = subClass;
  subClass.__proto__ = superClass;
}

var version = "1.0.1";

var Plugin = videojs.getPlugin('plugin');
var Button = videojs.getComponent('button'); // Default options for the plugin.

var defaults = {};

var RotateButton =
/*#__PURE__*/
function (_Button) {
  _inheritsLoose(RotateButton, _Button);

  /**
   * Create rotate button.
   *
   * @param  {Player} player
   *         A Video.js Player instance.
   *
   * @param  {Object} [options]
   *         An optional options object.
   *
   *         While not a core part of the Video.js plugin architecture, a
   *         second argument of options is a convenient way to accept inputs
   *         from your plugin's caller.
   */
  function RotateButton(player, options) {
    var _this;

    _this = _Button.call(this, player, options) || this;
    _this._currentRotateDeg = 0;

    _this.controlText('Rotate');

    return _this;
  }

  var _proto = RotateButton.prototype;

  _proto.buildCSSClass = function buildCSSClass() {
    return 'vjs-control vjs-button rotate-0';
  };

  _proto.handleClick = function handleClick() {
    this.removeClass("rotate-" + this._currentRotateDeg);
    var tmpRotateDeg = this._currentRotateDeg + 90;
    var zoom = tmpRotateDeg % 180 === 0 ? 1 : 0.5;

    if (tmpRotateDeg % 360 === 0) {
      this._currentRotateDeg = 0;
    }

    this._currentRotateDeg = tmpRotateDeg % 360 === 0 ? 0 : tmpRotateDeg;
    this.player().rotatePlayerPlugin().rotate({
      rotate: this._currentRotateDeg,
      zoom: zoom
    });
    this.addClass("rotate-" + this._currentRotateDeg);
  };

  return RotateButton;
}(Button);
/**
 * An advanced Video.js plugin. For more information on the API
 *
 * See: https://blog.videojs.com/feature-spotlight-advanced-plugins/
 */


var RotatePlayerPlugin =
/*#__PURE__*/
function (_Plugin) {
  _inheritsLoose(RotatePlayerPlugin, _Plugin);

  /**
   * Create a RotatePlayerPlugin plugin instance.
   *
   * @param  {Player} player
   *         A Video.js Player instance.
   *
   * @param  {Object} [options]
   *         An optional options object.
   *
   *         While not a core part of the Video.js plugin architecture, a
   *         second argument of options is a convenient way to accept inputs
   *         from your plugin's caller.
   */
  function RotatePlayerPlugin(player, options) {
    var _this2;

    // the parent class will add player under this.player
    _this2 = _Plugin.call(this, player) || this;
    _this2.options = videojs.mergeOptions(defaults, options); // Browser support rotate css property.

    _this2._prop = null;

    _this2.player.ready(function () {
      _this2.player.addClass('vjs-rotate-player-plugin');

      _this2.findSupportTransformProperty();

      _this2.player.getChild('controlBar').addChild('rotatePlayerButton');
    });

    return _this2;
  }
  /**
   * Find current browser supported transform css property.
   */


  var _proto2 = RotatePlayerPlugin.prototype;

  _proto2.findSupportTransformProperty = function findSupportTransformProperty() {
    var player = this.player;
    var properties = ['transform', 'WebkitTransform', 'MozTransform', 'msTransform', 'OTransform'];
    this._prop = properties[0];

    if (typeof player.style !== 'undefined') {
      for (var _i = 0; _i < properties.length; _i++) {
        var property = properties[_i];

        if (typeof player.style[property] !== 'undefined') {
          this._prop = property;
          break;
        }
      }
    }
  };

  _proto2.rotate = function rotate(options) {
    var targetElement = this.player.el();
    var videoElement = targetElement.getElementsByClassName('vjs-tech')[0];
    var posterElement = targetElement.getElementsByClassName('vjs-poster')[0];
    targetElement.style.overflow = 'hidden';
    videoElement.style[this._prop] = "scale(" + options.zoom + ") rotate(" + options.rotate + "deg)";
    posterElement.style[this._prop] = "scale(" + options.zoom + ") rotate(" + options.rotate + "deg)";
  };

  return RotatePlayerPlugin;
}(Plugin); // Define default values for the plugin's `state` object here.


RotatePlayerPlugin.defaultState = {}; // Include the version number.

RotatePlayerPlugin.VERSION = version; // Register button.

videojs.registerComponent('rotatePlayerButton', RotateButton); // Register the plugin with video.js.

videojs.registerPlugin('rotatePlayerPlugin', RotatePlayerPlugin);

module.exports = RotatePlayerPlugin;
