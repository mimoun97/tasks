<template>
  <span>
    <v-btn :disabled="disabled" :loading="sending" round color="pink elevation-0" placeholder="Send push notifiacation">
      <span>Send push notifiacation</span>
      <v-icon right>notifications</v-icon>
    </v-btn>
  </span>
</template>

<script>
//TODO import pushSubscriptions from ..
export default {
  name: "PushNotificationsButton",
  data () {
    return {
      disabled: false,
      sending: false,
    }
  },
};
</script>

<style>
</style>
