<template>
  <v-card flat>
    <v-card-title class="title">Online state</v-card-title>
    <v-card-text>
      <p class="grey--text text--lighten-1 body-1">
        Canvia l'estat de connexió per veure els canvis <b>No cal actualitzar la pàgina.</b>
      </p>
      <p>
        Connection state changed to
        <b class="headline" :class="online ? 'red--text' : 'green--text'">{{ online ? 'offline' : 'online' }}.</b>
      </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "OnlineState",
  data() {
    return {
      online: this.onLine
    };
  },
  computed: {
    onLine: function() {
      return navigator.onLine;
    }
  },
  methods: {
    handleStateChange: function() {
      this.online = !this.online;
    }
  },
  created: function() {
    window.addEventListener("online", this.handleStateChange);
    window.addEventListener("offline", this.handleStateChange);
  }
};
</script>

<style>
</style>
