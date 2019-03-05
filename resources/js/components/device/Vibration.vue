<template>
  <v-card flat class="text-xs-center">
    <v-card-title class="title">Vibration</v-card-title>
    <v-card-text class="grey--text lighten-2">
      <p
        class="grey--text text--lighten-1 body-1"
      >The Vibration API allows Web applications to use the device's built-in vibration, if one is present.</p>
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn color="blue" dark @click="vibrateSimple">Simple
        <v-icon right>vibration</v-icon>
      </v-btn>
      <v-btn color="pink accent-3" dark @click="vibratePattern">Pattern
        <v-icon right>vibration</v-icon>
      </v-btn>
      <v-btn color="red accent-3" dark @click="stopVibration">Stop vibration
        <v-icon right>cancel</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>
// SEE https://googlechrome.github.io/samples/vibration/
<script>
export default {
  name: "Vibration",
  methods: {
    vibrateSimple: function() {
      if (navigator.vibrate) navigator.vibrate(200);
    },
    vibratePattern: function() {
      if (navigator.vibrate) navigator.vibrate([100, 200, 200, 200, 500]);
    },
    stopVibration: function() {
      navigator.vibrate(0);
    }
  }
};
</script>

<style>
</style>