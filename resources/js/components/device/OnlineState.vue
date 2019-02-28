<template>
  <div>
    <p class="title">Online state</p>
    <p>Connection state changed to
      <b class="headline">{{ online ? 'offline' : 'online' }}.</b>
    </p>
  </div>
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
