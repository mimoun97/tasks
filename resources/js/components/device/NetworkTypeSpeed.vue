<template>
  <div>
    <p class="title">Network type Speed</p>
    <p>
      Current theoretical network type is
      <b>{{ dataInfo.type || 'undefined'}}</b>.
    </p>
    <p>
      Current effective network type is
      <b>{{ dataInfo.effectiveType || 'undefined' }}</b>.
    </p>
    <p>
      Current max downlink speed is
      <b>{{ dataInfo.downlinkMax || 'undefined'}}</b>.
    </p>
  </div>
</template>

<script>
export default {
  name: "NetworkTypeSpeed",
  data() {
    return {
      dataInfo: this.info
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
    handle: function() {
      this.dataInfo = this.getConnection()
    }
  },
  computed: {
    info:function () {
      return this.getConnection();
    }
  },
  created: function() {
    navigator.connection.addEventListener("change", this.handle);
  }
};
</script>

<style>
</style>
