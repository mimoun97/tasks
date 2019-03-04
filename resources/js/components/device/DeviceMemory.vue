<template>
  <div>
    <p class="title">Device Memory</p>
    <p>
      Your device memory is ~
      <b v-if="memory">{{memory}} GiB.</b> 
    </p>
  </div>
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
      return navigator.deviceMemory.toLocaleString()	
    }
  }
};
</script>

<style>
</style>
