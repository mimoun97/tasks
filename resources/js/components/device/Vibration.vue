<template>
  <div>
    <p class="title">Vibration</p>
    <v-btn color="blue" dark :disabled="canVibrate" @click="vibrateSimple"><v-icon class="mr-3">vibration</v-icon>Simple</v-btn>
    <v-btn color="pink accent-3" dark :disabled="canVibrate" @click="vibratePattern"><v-icon class="mr-3">vibration</v-icon>Pattern</v-btn>
  </div>
</template>

<script>
export default {
  name: "Vibration",
  data: function() {
    return {
      canVibrate: this.canvibrate
    };
  },
  computed: {
    canvibrate: function() {
      return navigator.vibrate || false;
    }
  },
  methods: {
    vibrateSimple: function() {
      if (navigator.vibrate) navigator.vibrate(200);
    },
    vibratePattern: function() {
      if (navigator.vibrate) navigator.vibrate([100, 200, 200, 200, 500]);
    }
  }
};
</script>

<style>
</style>