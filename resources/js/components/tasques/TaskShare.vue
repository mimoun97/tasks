<template>
  <v-btn icon color="grey" flat @click="share" v-if="show" aria-label="Compartir">
    <v-icon>share</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "TaskShare",
  data() {
    return {
        show: false,
    };
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  methods: {
    share() {
      if (navigator.share) {
          navigator
        .share({
          title: this.task.name,
          text: this.task.description.slice(50),
          url: window.location.hostname + "/tasques/" + this.task.id
        })
        .then(() => console.log("Successful share"))
        .catch(error => console.log("Error sharing:", error));
      }
    }
  },
  mounted() {
      if ("share" in navigator) {
          this.show = true
      }
  },
};
</script>