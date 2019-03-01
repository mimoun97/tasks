<template>
<v-container>
  <v-layout row fill-height>
      <div class="title">
        <li>Informació de la bateria</li>
        <li>Estat: online/offline</li>
        <li>Network type and speed</li>
        <li>Device memory</li>
        <li>GEOLOCATION: GPS</li>
        <li>Screen Orientation</li>
        <li>Vibrar el mòbil </li>
</div>
      <v-flex xs12>
        <v-card-text>
          <battery-status/>
        </v-card-text>
      </v-flex>
      <v-divider></v-divider>
      <v-flex xs12>
        <v-card-text>
          <online-state/>
        </v-card-text>
      </v-flex>
      <v-divider></v-divider>
      <v-flex xs12>
        <v-card-text>
          <network-type-speed/>
        </v-card-text>
      </v-flex>
      <v-flex xs12>
        <v-card-text>
          <device-memory/>
        </v-card-text>
      </v-flex>
      <v-divider></v-divider>
      <v-flex xs12>
        <v-card-text>
          <screen-orientation/>
        </v-card-text>
      </v-flex>
      <v-divider></v-divider>
      <v-flex xs12>
        <v-card-text>
          <geolocation/>
        </v-card-text>
      </v-flex>
      <v-divider></v-divider>
      <v-flex xs12>
        <v-card-text>
          <vibration/>
        </v-card-text>
      </v-flex>
    </v-card>
  </v-layout>
</v-container>
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
    "geolocation": Geolocation,
    "vibration": Vibration,
    "device-memory": DeviceMemory
  }
};
</script>

<style>
</style>