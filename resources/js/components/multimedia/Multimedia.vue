<template>
  <div>
    <v-card color="grey" dark>
      <v-card-title>
        <h2>Video bla bla bla</h2>
      </v-card-title>
      <v-card-media>
        <video
          ref="demovideo"
          src="http://clips.vorwaerts-gmbh.de/VfE_html5.mp4"
          preload="auto"
          
        ></video>
      </v-card-media>
      <v-card-actions>
        <v-btn icon color="primary" dark @click="video.playbackRate = 0.5">
          <v-icon>fast_rewind</v-icon>
        </v-btn>
        <v-btn icon color="primary" dark @click="video.play()">
          <v-icon>play_arrow</v-icon>
        </v-btn>
        <v-btn icon color="primary" dark @click="video.pause()">
          <v-icon>pause</v-icon>
        </v-btn>
        <v-btn icon color="primary" dark @click="video.stop()">
          <v-icon>stop</v-icon>
        </v-btn>
        <v-btn icon color="primary" dark @click="video.playbackRate = 2">
          <v-icon>fast_forward</v-icon>
        </v-btn>
        <v-slider
          color="primary"
          class="ml-2"
          min="0"
          max="1"
          step="0.1"
          v-model="video.volume"
          append-icon="volume_up"
        ></v-slider>
      </v-card-actions>
    </v-card>
    <v-card color="grey" dark class="my-2">
      <v-card-title>
        <h2>Back in black:</h2>
      </v-card-title>
      <v-card-media>
        <audio
          ref="demoaudio1"
          src="https://upload.wikimedia.org/wikipedia/en/4/45/ACDC_-_Back_In_Black-sample.ogg"
          preload="auto"
          
        ></audio>
      </v-card-media>
      <v-card-actions>
        <div>
          <v-btn icon dark color="primary" @click="audio1.play()">
            <v-icon>play_arrow</v-icon>
          </v-btn>
          <v-btn icon dark color="primary" @click="audio1.pause()">
            <v-icon>pause</v-icon>
          </v-btn>
          <v-slider
            color="primary"
            class="ml-2"
            min="0"
            max="1"
            step="0.1"
            v-model="audio1.volume"
            append-icon="volume_up"
          ></v-slider>
        </div>
      </v-card-actions>
    </v-card>

    <v-card color="grey" dark class="my-2">
      <v-card-title>
        <h2>Audio Another day in paradise:</h2>
      </v-card-title>
      <v-card-media>
        <audio
          ref="demoaudio2"
          src="https://upload.wikimedia.org/wikipedia/en/9/9f/Sample_of_%22Another_Day_in_Paradise%22.ogg"
          preload="auto"
          controls
        ></audio>
      </v-card-media>
      <v-card-actions>
        <div>
          <v-btn icon dark color="primary" @click="audio2.play()">
            <v-icon>play_arrow</v-icon>
          </v-btn>
          <v-btn icon dark color="primary" @click="audio2.pause()">
            <v-icon>pause</v-icon>
          </v-btn>
          <v-slider
            color="primary"
            class="ml-2"
            min="0"
            max="1"
            step="0.1"
            v-model="audio2.volume"
            append-icon="volume_up"
          ></v-slider>
        </div>
      </v-card-actions>
    </v-card>

    <v-card color="grey lighten-3"  class="my-2">
      <v-card-title>
        <h2>Audio Bullet in the head:</h2>
      </v-card-title>
      <v-card-media>
        <audio
          ref="demoaudio3"
          src="https://upload.wikimedia.org/wikipedia/en/1/17/Bullet_In_The_Head.ogg"
          preload="auto"
          
        ></audio>
      </v-card-media>
      <v-card-actions>
        <div>
          <v-btn icon dark color="primary" @click="audio3.play()">
            <v-icon>play_arrow</v-icon>
          </v-btn>
          <v-btn icon dark color="primary" @click="audio3.pause()">
            <v-icon>pause</v-icon>
          </v-btn>
          <v-slider
            color="primary"
            class="ml-2"
            min="0"
            max="1"
            step="0.1"
            v-model="audio3.volume"
            append-icon="volume_up"
          ></v-slider>
        </div>
      </v-card-actions>
    </v-card>

    <v-btn flat color="blue"><a href="https://developer.mozilla.org/es/docs/Web/HTML/Usando_audio_y_video_con_HTML5">Més info</a></v-btn>
    
  </div>
</template>

<script>
export default {
  name: "Multimedia",
  data() {
    return {
      video: {},
      audio1: {},
      audio2: {},
      audio3: {}
    };
  },
  mounted() {
    this.video = this.$refs.demovideo;
    this.audio1 = this.$refs.demoaudio1;
    this.audio2 = this.$refs.demoaudio2;
    this.audio3 = this.$refs.demoaudio3;
    console.log("VIDEOOOOOOOO REFS: ", this.$refs.demovideo);
  }
};
</script>

<style>
</style>
