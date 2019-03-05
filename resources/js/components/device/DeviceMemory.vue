<template>
  <v-card flat class="text-xs-center">
    <v-card-title class="title">Device Memory</v-card-title>
    <v-card-text>
      <p>
        Your device memory is ~
        <b>{{memory}} GiB.</b>
      </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "DeviceMemory",
  data: function() {
    return {
      memory: "unknown"
    };
  },
  created() {
    this.memory = navigator.deviceMemory.toLocaleString();
  }
  
};
</script>

<style>
</style>
