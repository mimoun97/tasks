<template>
  <div class="primary--text grey lighten-4">
    <p>Current theoretical network type is
      <b v-if="info.type">{{ info.type }}</b>.
    </p>
    <p>Current effective network type is
      <b>{{ info.effectiveType }}</b>.
    </p>
    <p>Current max downlink speed is
      <b>{{ info.downlinkMax }}</b>.
    </p>
  </div>
</template>

<script>
export default {
  name: "NetworkTypeSpeed",
  data() {
    return {
      dataInfo: info
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
    }
  },
  computed: {
    info() {
      return this.getConnection() || "No connected"
    }
  }
};
</script>

<style>
</style>
