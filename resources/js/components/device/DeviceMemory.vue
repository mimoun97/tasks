<template>
  <v-card flat>
    <v-card-title class="title">Device Memory</v-card-title>
    <v-card-text>
      <p class="grey--text text--lighten-1 body-1">The
        <strong>
          <code>deviceMemory</code>
        </strong> read-only property of the
        <a
          href="/en-US/docs/Web/API/Navigator"
          title="The Navigator interface represents the state and the identity of the user agent. It allows scripts to query it and to register themselves to carry on some activities."
        >
          <code>navigator</code>
        </a> interface returns the amount of device memory in gigabytes.
      </p>
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
