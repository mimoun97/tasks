<template>
  <v-btn absolute dark fab bottom right color="accent" @click="show()">
    <v-icon>share</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "ShareFab",
  data() {
    return {
      dialog: false
    };
  },
  methods: {
    show() {
      if (!("share" in navigator)) {
        alert("Web Share API not supported.");
        return;
      }

      navigator
        .share({
          title: "App Tasques",
          text: "Aplicació de tasques",
          url: "https://tasks.mimoun1997.scool.cat/"
        })
        .then(() => console.log("Successful share"))
        .catch(error => console.log("Error sharing:", error));
    }
  }
};
</script>

<style>
</style>
