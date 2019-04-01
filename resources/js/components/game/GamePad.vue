<template>
  <v-content>
    <h1>PLay!</h1>
    <p>Press a button to activate your game controller.</p>
    <div id="ball"></div>
  </v-content>
</template>

<script>
export default {
  name: "GamePad",
  created() {
    var ball;

    window.addEventListener("gamepadconnected", function(e) {
      ball = document.getElementById("ball");
      ball.style.backgroundColor = "green";
      document.getElementsByTagName("p")[0].innerHTML = e.gamepad.id;
      updateLoop();
    });

    function updateLoop() {
      var gp = navigator.getGamepads()[0];
      var left =
        ((gp.axes[0] + 1) / 2) * (window.innerWidth - ball.offsetWidth);
      var right =
        ((gp.axes[1] + 1) / 2) * (window.innerHeight - ball.offsetHeight);

      ball.style.left = left + "px";
      ball.style.top = right + "px";

      if (gp.buttons[0].pressed) {
        document.body.style.backgroundColor = "red";
      } else {
        document.body.style.backgroundColor = "white";
      }

      requestAnimationFrame(updateLoop);
    }
  }
};
</script>

<style>
#ball {
    position: absolute;
    left: calc(50vw - 25px);
    top: calc(50vh - 25px);
    background-color: red;
    width: 50px;
    height: 50px;
    border-radius: 25px;
}
</style>
