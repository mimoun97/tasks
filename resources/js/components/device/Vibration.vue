<template>
  <div>
    <p class="title">Vibration</p>
    <code lang="java" class="--text grey lighten-4">
      function vibrateSimple() {
        navigator.vibrate(200);
      }
      function vibratePattern() {
        navigator.vibrate([100, 200, 200, 200, 500]);
      }
    </code>
  </div>
</template>

<script>
export default {
  name: "Vibration"
};
</script>

<style>
</style>
  // TODO
