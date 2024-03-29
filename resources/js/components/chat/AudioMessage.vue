<template>
    <div class="mb-3 message message-audio" :class="{'message-right':owner,'message-left':!owner}">
        <span></span>
        <div class="message-in tail">
            <span class="tail-container"></span>
            <span class="tail-container highlight"></span>
            <div>
                <div role="">
                    <span dir="auto" class="message-author">Pepe Jeans</span>
                </div>
                <div class="message-body py-2 text-left">
                    <div>
                        <v-layout row>
                            <v-flex xs3 class="text-right">
                                <v-avatar
                                    color="grey lighten-4"
                                >
                                    <img :src="avatar" alt="avatar">
                                </v-avatar>
                                <svg class="microphone-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 19 26" width="19" height="26"><path fill="#DDF6C9" d="M9.217 24.401c-1.158 0-2.1-.941-2.1-2.1v-2.366c-2.646-.848-4.652-3.146-5.061-5.958l-.052-.357-.003-.081a2.023 2.023 0 0 1 .571-1.492c.39-.404.939-.637 1.507-.637h.3c.254 0 .498.044.724.125v-6.27A4.27 4.27 0 0 1 9.367 1a4.27 4.27 0 0 1 4.265 4.265v6.271c.226-.081.469-.125.723-.125h.3c.564 0 1.112.233 1.501.64s.597.963.571 1.526c0 .005.001.124-.08.6-.47 2.703-2.459 4.917-5.029 5.748v2.378c0 1.158-.942 2.1-2.1 2.1h-.301v-.002z"></path><path fill="#798A79" d="M9.367 15.668a2.765 2.765 0 0 0 2.765-2.765V5.265a2.765 2.765 0 0 0-5.529 0v7.638a2.764 2.764 0 0 0 2.764 2.765zm5.288-2.758h-.3a.64.64 0 0 0-.631.598l-.059.285a4.397 4.397 0 0 1-4.298 3.505 4.397 4.397 0 0 1-4.304-3.531l-.055-.277a.628.628 0 0 0-.629-.579h-.3a.563.563 0 0 0-.579.573l.04.278a5.894 5.894 0 0 0 5.076 4.978v3.562c0 .33.27.6.6.6h.3c.33 0 .6-.27.6-.6V18.73c2.557-.33 4.613-2.286 5.051-4.809.057-.328.061-.411.061-.411a.57.57 0 0 0-.573-.6z"></path></svg>
                            </v-flex>
                            <v-flex xs1 class="text-center">
                                <v-icon large class="mt-2" color="rgb(121, 136, 109)" v-if="!playing || paused" @click="play()">play_arrow</v-icon>
                                <v-icon large class="mt-2" color="rgb(121, 136, 109)" v-else @click="pause()">pause</v-icon>
                            </v-flex>
                            <v-flex xs7 class="offset-xs1">
                                <v-slider class="mt-2" color="rgb(121, 136, 109)" @click="setPosition()" v-model="percentage" dark :disabled="!loaded"></v-slider>
                                <p class="audio-time" v-if="!playing || paused">{{ duration }}</p>
                                <p class="audio-time" v-else>{{ currentTime }}</p>
                            </v-flex>
                        </v-layout>
                    </div>
                </div>
                <div class="message-time">
                    <div>
                        <span>16:32</span>
                    </div>
                </div>
            </div>
            <span></span>
        </div>
        <audio id="player" ref="player" :src="file"></audio>
    </div>
</template>

<script>
const formatTime = (second) => {
  if (second >= 3600) return new Date(second * 1000).toISOString().substr(11, 8)
  else return new Date(second * 1000).toISOString().substr(14, 5)
}

export default {
  name: 'AudioMessage',
  props: {
    file: {
      type: String,
      default: null
    },
    owner: {
      type: Boolean
    }
  },
  computed: {
    duration () {
      return this.audio ? formatTime(this.totalDuration) : ''
    },
    avatar () {
      return window.laravel_user.avatar
    }
  },
  data () {
    return {
      firstPlay: true,
      isMuted: false,
      loaded: false,
      playing: false,
      paused: false,
      percentage: 0,
      currentTime: '00:00',
      audio: undefined,
      totalDuration: 0
    }
  },
  methods: {
    setPosition () {
      this.audio.currentTime = parseInt(this.audio.duration / 100 * this.percentage)
    },
    play () {
      this.paused = false
      this.audio.play().then(() => this.playing = true)
    },
    pause () {
      this.paused = !this.paused;
      (this.paused) ? this.audio.pause() : this.audio.play()
    },
    download () {
      this.audio.pause()
      window.open(this.file, 'download')
    },
    mute () {
      this.isMuted = !this.isMuted
      this.audio.muted = this.isMuted
      this.volumeValue = this.isMuted ? 0 : 75
    },
    reload () {
      this.audio.load()
    },
    handleLoaded: function () {
      if (this.audio.readyState >= 2) {
        if (this.audio.duration === Infinity) {
          this.audio.currentTime = 1e101
          this.audio.ontimeupdate = () => {
            this.audio.ontimeupdate = () => {}
            this.audio.currentTime = 0
            this.totalDuration = parseInt(this.audio.duration)
            this.loaded = true
          }
        } else {
          this.totalDuration = parseInt(this.audio.duration)
          this.loaded = true
        }
        if (this.autoPlay) this.audio.play()
      } else {
        throw new Error('Failed to load sound file')
      }
    },
    handlePlayingUI: function (e) {
      this.percentage = this.audio.currentTime / this.audio.duration * 100
      this.currentTime = formatTime(this.audio.currentTime)
    },
    handlePlayPause: function (e) {
      if (e.type === 'play' && this.firstPlay) {
        // in some situations, audio.currentTime is the end one on chrome
        this.audio.currentTime = 0
        if (this.firstPlay) {
          this.firstPlay = false
        }
      }
      if (e.type === 'pause' && this.paused === false && this.playing === false) {
        this.currentTime = '00:00'
      }
    },
    handleEnded () {
      this.paused = this.playing = false
    },
    init: function () {
      this.audio.addEventListener('timeupdate', this.handlePlayingUI)
      this.audio.addEventListener('loadeddata', this.handleLoaded)
      this.audio.addEventListener('pause', this.handlePlayPause)
      this.audio.addEventListener('play', this.handlePlayPause)
      this.audio.addEventListener('ended', this.handleEnded)
    }
  },
  mounted () {
    this.audio = this.$refs.player
    this.init()
  },
  beforeDestroy () {
    this.audio.removeEventListener('timeupdate', this.handlePlayingUI)
    this.audio.removeEventListener('loadeddata', this.handleLoaded)
    this.audio.removeEventListener('pause', this.handlePlayPause)
    this.audio.removeEventListener('play', this.handlePlayPause)
    this.audio.removeEventListener('ended', this.handleEnded)
  }
}
</script>

<style scoped>
.audio-time{
    color: rgba(0, 0, 0, 0.45);
    font-size: 11px;
    line-height: 15px;
    margin-bottom: 0px;
    margin-top: -45px;
}
.microphone-icon{
    position: absolute;
    bottom: 4px;
    height: 20px;
    left: 40px;
}
</style>
