<template>
  <v-card class="text-xs-center">
    <v-card-title>Device Memory</v-card-title>
    <v-card-text>
      <p>
        Your device memory is ~
        <b v-if="memory">{{memory}} GiB.</b>
      </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "DeviceMemory",
  data: function() {
    return {
      memory: this.deviceMemory || "unknown"
    };
  },
  computed: {
    deviceMemory: function() {
      return navigator.deviceMemory.toLocaleString();
    }
  }
};
</script>

<style>
</style>
