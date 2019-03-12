<template>
  <v-card flat>
    <v-card-title class="title">Network type Speed</v-card-title>
    <v-card-text class="body-2">
      <p>
      Current theoretical network type is
      <b>{{ dataInfo.type || 'unknown'}}</b>.
    </p>
    <p>
      Current effective network type is
      <b>{{ dataInfo.effectiveType}}</b>.
    </p>
    <p>
      Current max downlink speed is
      <b>{{ dataInfo.downlink }} Mbps</b>.
    </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "NetworkTypeSpeed",
  data() {
    return {
      dataInfo: {}
    };
  },
  methods: {
    getConnection() {
      return (
        navigator.connection ||
        navigator.mozConnection ||
        navigator.webkitConnection ||
        navigator.msConnection
      );
    },
    handle() {
      this.dataInfo = this.getConnection();
    }
  },
  created: function() {
    this.dataInfo = this.getConnection();
    console.log(this.dataInfo)
    navigator.connection.addEventListener("change", this.handle());
  }
};
</script>

<style>
</style>
