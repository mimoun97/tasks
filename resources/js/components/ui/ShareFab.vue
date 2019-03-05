<template>
  <v-btn
    v-if="canShare"
    absolute
    dark
    fab
    bottom
    right
    color="accent"
    @click="show()"
    aria-label="Share"
  >
    <v-icon>share</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "ShareFab",
  data() {
    return {
      dialog: false,
      canShare: false
    };
  },
  methods: {
    show() {
      if (!("share" in navigator)) return;

      navigator
        .share({
          title: "App Tasques",
          text: "Aplicació de tasques",
          url: "https://tasks.mimoun1997.scool.cat/"
        })
        .then(() => this.$snackbar.showMessage("Thanks for sharing"))
        .catch(error => this.$snackbar.showError("Error: " + error));
    }
  },
  created() {
    this.canShare = ("share" in navigator);
  }
};
</script>

<style>
</style>
