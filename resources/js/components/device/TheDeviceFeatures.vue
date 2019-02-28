<template>
    <v-card>
        <network-type-speed />
    </v-card>
</template>

<script>
export default {
  name: "TheDeviceFeatures",
  components: {
    "battery-status": BatteryStatus,
    "online-offline": OnlineOffline,
    "network-type-speed": NetworkTypeSpeed,
    "screen-orientation": ScreenOrientation
  },
  data() {
    return {
      dataInfo: info
    };
  },
  props: {},
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
      info () {
          return this.getConnection()
      }
  },
  created() {
    /**Informació de la bateria
Estat: online/offline
Network type and speed
Device memory
GEOLOCATION: GPS
Screen Orientation
Vibrar el mòbil */
  }
};
</script>

<style>
</style>
