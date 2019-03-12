<template>
  <v-card flat>
    <v-card-title class="title">Screen Orientation</v-card-title>

    <v-card-text>
      <p class="grey--text text--lighten-1 body-1">
        The
        <b>Screen Orientation API</b> allows Web applications to get the information about the current orientation of the document
        (portrait or landscape) as well as to lock the screen orientation in a requested state.
      </p>
      <p>
        Current screen orientation is
        <b v-text="orientation || 'unknown'"></b>.
      </p>
    </v-card-text>

    <v-card-actions class="justify-center">
      <v-btn color="grey" dark id="unlock"><span v-text="isLocked ? 'Release the lock' : 'Lock'"></span>
        <v-icon right>orientation_lock</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  // TODO release the lock
  name: "ScreenOrientation",
  data: function() {
    return {
      orientation: null,
      orientKey: "orientation",
      isLocked: false,
    };
  },
  methods: {
    update() {
      if (!screen[this.orientKey]) return;
      let type = screen[this.orientKey].type || screen[this.orientKey];
      this.orientation = type;
    },
    setOrientKey() {
      if ("mozOrientation" in screen) {
        this.orientKey = "mozOrientation";
      } else if ("msOrientation" in screen) {
        this.orientKey = "msOrientation";
      }
    },
    onOrientationChange() {
      this.update();
    },
    lock(lockType) {
      window.screen.orientation.lock(lockType)
    },
    unlock() {
      //TODO
    }
  },
  created() {
    this.setOrientKey();

    if (screen[this.orientKey]) {
      this.update();
    }

    if ("onchange" in screen[this.orientKey]) {
      //new api
      this.update();

      screen[this.orientKey].addEventListener("change", this.onOrientationChange);
    } else if ("onorientationchange" in screen) {
      // older API
      this.update();

      screen.addEventListener("orientationchange", this.onOrientationChange);
    }
  }
};
</script>

<style>
</style>
/**
var app = new Vue({
  el: '#app',
  data: function() {
    return {
      msg: 'Hello World! This is a Event listener test.',
      windowWidth: 0,
      windowHeight: 0,
    }
  },

  mounted() {
    this.$nextTick(function() {
      window.addEventListener('resize', this.getWindowWidth);
      window.addEventListener('resize', this.getWindowHeight);

      //Init
      this.getWindowWidth()
      this.getWindowHeight()
    })

  },

  methods: {
    getWindowWidth(event) {
        this.windowWidth = document.documentElement.clientWidth;
      },

      getWindowHeight(event) {
        this.windowHeight = document.documentElement.clientHeight;
      }
  },
  beforeDestroy() {
    window.removeEventListener('resize', this.getWindowWidth);
    window.removeEventListener('resize', this.getWindowHeight);
  }
});

//////////////////////////////////////******************///////////////////////// */
var $ = document.getElementById.bind(document);

var orientKey = 'orientation';
if ('mozOrientation' in screen) {
  orientKey = 'mozOrientation';
} else if ('msOrientation' in screen) {
  orientKey = 'msOrientation';
}

var target = $('logTarget');
var device = $('device');
var orientationTypeLabel = $('orientationType');

function logChange (event) {
  var timeBadge = new Date().toTimeString().split(' ')[0];
  var newState = document.createElement('p');
  newState.innerHTML = '<span class="badge">' + timeBadge + '</span> ' + event + '.';
  target.appendChild(newState);
}

if (screen[orientKey]) {
  function update() {
    var type = screen[orientKey].type || screen[orientKey];
    orientationTypeLabel.innerHTML = type;

    var landscape = type.indexOf('landscape') !== -1;

    if (landscape) {
      device.style.width = '180px';
      device.style.height = '100px';
    } else {
      device.style.width = '100px';
      device.style.height = '180px';
    }

    var rotate = type.indexOf('secondary') === -1 ? 0 : 180;
    var rotateStr = 'rotate(' + rotate + 'deg)';

    device.style.webkitTransform = rotateStr;
    device.style.MozTransform = rotateStr;
    device.style.transform = rotateStr;
  }

  update();

  var onOrientationChange = null;

  if ('onchange' in screen[orientKey]) { // newer API
    onOrientationChange = function () {
      logChange('Orientation changed to <b>' + screen[orientKey].type + '</b>');
      update();
    };
  
    screen[orientKey].addEventListener('change', onOrientationChange);
  } else if ('onorientationchange' in screen) { // older API
    onOrientationChange = function () {
      logChange('Orientation changed to <b>' + screen[orientKey] + '</b>');
      update();
    };
  
    screen.addEventListener('orientationchange', onOrientationChange);
  }

  // browsers require full screen mode in order to obtain the orientation lock
  var goFullScreen = null;
  var exitFullScreen = null;
  if ('requestFullscreen' in document.documentElement) {
    goFullScreen = 'requestFullscreen';
    exitFullScreen = 'exitFullscreen';
  } else if ('mozRequestFullScreen' in document.documentElement) {
    goFullScreen = 'mozRequestFullScreen';
    exitFullScreen = 'mozCancelFullScreen';
  } else if ('webkitRequestFullscreen' in document.documentElement) {
    goFullScreen = 'webkitRequestFullscreen';
    exitFullScreen = 'webkitExitFullscreen';
  } else if ('msRequestFullscreen') {
    goFullScreen = 'msRequestFullscreen';
    exitFullScreen = 'msExitFullscreen';
  }

  $('lock').addEventListener('click', function () {
    document.documentElement[goFullScreen] && document.documentElement[goFullScreen]();

    var promise = null;
    if (screen[orientKey].lock) {
      promise = screen[orientKey].lock(screen[orientKey].type);
    } else {
      promise = screen.orientationLock(screen[orientKey]);
    }

    promise
      .then(function () {
        logChange('Screen lock acquired');
        $('unlock').style.display = 'block';
        $('lock').style.display = 'none';
      })
      .catch(function (err) {
        logChange('Cannot acquire orientation lock: ' + err);
        document[exitFullScreen] && document[exitFullScreen]();
      });
  });

  $('unlock').addEventListener('click', function () {
    document[exitFullScreen] && document[exitFullScreen]();

    if (screen[orientKey].unlock) {
      screen[orientKey].unlock();
    } else {
      screen.orientationUnlock();
    }

    logChange('Screen lock removed.');
    $('unlock').style.display = 'none';
    $('lock').style.display = 'block';
  });
}
 */
