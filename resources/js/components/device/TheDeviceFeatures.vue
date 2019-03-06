<template>
  <v-card>
    <v-flex xs12 my-2>
      <v-card-text>
        <battery-status/>
      </v-card-text>
    </v-flex>
    <v-divider></v-divider>
    <v-flex xs12 my-2>
      <v-card-text>
        <online-state/>
      </v-card-text>
    </v-flex>
    <v-divider></v-divider>
    <v-flex xs12 my-2>
      <v-card-text>
        <network-type-speed/>
      </v-card-text>
    </v-flex>
    <v-divider></v-divider>
    <v-flex xs12 my-2>
      <v-card-text>
        <device-memory/>
      </v-card-text>
    </v-flex>
    <v-divider></v-divider>
    <v-flex xs12 my-2>
      <v-card-text>
        <screen-orientation/>
      </v-card-text>
    </v-flex>
    <v-divider></v-divider>
    <v-flex xs12 my-2>
      <v-card-text>
        <geolocation/>
      </v-card-text>
    </v-flex>
    <v-divider></v-divider>
    <v-flex xs12 my-2>
      <v-card-text>
        <vibration/>
      </v-card-text>
    </v-flex>
  </v-card>
</template>

<script>
import BatteryStatus from "./BatteryStatus.vue";
import OnlineState from "./OnlineState.vue";
import NetworkTypeSpeed from "./NetworkTypeSpeed.vue";
import ScreenOrientation from "./ScreenOrientation.vue";
import Geolocation from "./Geolocation.vue";
import Vibration from "./Vibration.vue";
import DeviceMemory from "./DeviceMemory";

export default {
  name: "TheDeviceFeatures",
  components: {
    "battery-status": BatteryStatus,
    "online-state": OnlineState,
    "network-type-speed": NetworkTypeSpeed,
    "screen-orientation": ScreenOrientation,
    geolocation: Geolocation,
    vibration: Vibration,
    "device-memory": DeviceMemory
  }
};
</script>

<style>
</style>