<template>
    <code>
        function vibrateSimple() {
  navigator.vibrate(200);
}

function vibratePattern() {
  navigator.vibrate([100, 200, 200, 200, 500]);
}
    </code>
</template>

<script>
export default {
    name: "Vibration"
}
</script>

<style>

</style>
