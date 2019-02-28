<template>
  <v-layout row>
    <v-card>
      <v-flex xs12>
        <v-card-text>
          <battery-status/>
        </v-card-text>
      </v-flex>
      <v-flex xs12>
        <v-card-text>
          <online-state/>
        </v-card-text>
      </v-flex>
      <v-flex xs12>
        <v-card-text>
          <network-type-speed/>
        </v-card-text>
      </v-flex>
      <v-flex xs12>
        <v-card-text>
          <screen-orientation/>
        </v-card-text>
      </v-flex>
      <v-flex xs12>
        <v-card-text>
          <geolocation/>
        </v-card-text>
      </v-flex>
      <v-flex xs12>
        <v-card-text>
          <vibration/>
        </v-card-text>
      </v-flex>
    </v-card>
  </v-layout>
</template>

<script>
import BatteryStatus from "./BatteryStatus.vue";
import OnlineState from "./OnlineState.vue";
import NetworkTypeSpeed from "./NetworkTypeSpeed.vue";
import ScreenOrientation from "./ScreenOrientation.vue";
import Geolocation from "./Geolocation.vue";
import Vibration from "./Vibration.vue";

export default {
  name: "TheDeviceFeatures",
  components: {
    "battery-status": BatteryStatus,
    "online-state": OnlineState,
    "network-type-speed": NetworkTypeSpeed,
    "screen-orientation": ScreenOrientation,
    "geolocation": Geolocation,
    "vibration": Vibration
  }
};
</script>

<style>
</style>