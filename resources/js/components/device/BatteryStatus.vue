<template>
  <v-card flat>
    <v-card-title class="title">Battery Status</v-card-title>
    <v-card-text class="body-2">
      <p>
        Initial battery status was
        <b v-text="battery.charging ? 'charging' : 'discharging'"></b>
      </p>
      <p>Charging time
        <b v-text="battery.chargingTime+ ' s'"></b>
      </p>
      <p>Discharging time
        <b v-text="battery.dischargingTime"></b>
      </p>
      <p>Level
        <b>{{ battery.level * 100 + "%" || 'unknown' }}</b>.
      </p>
    </v-card-text>
  </v-card>
</template>

<script>
export default {
  name: "BatteryStatus",
  data: function() {
    return {
      battery: {},
      change: null,
      timeBadge: null
    };
  },
  created() {
    var batteryPromise = {};
    if (
      "getBattery" in navigator ||
      ("battery" in navigator && "Promise" in window)
    ) {
      if ("getBattery" in navigator) {
        batteryPromise = navigator.getBattery();
      } else {
        batteryPromise = Promise.resolve(navigator.battery);
      }
    }

    batteryPromise.then(battery => {
      this.battery = battery;

      battery.addEventListener("chargingchange", this.onChargingChange());
      battery.addEventListener(
        "chargingtimechange",
        this.onChargingTimeChange()
      );
      battery.addEventListener(
        "dischargingtimechange",
        this.onDischargingTimeChange()
      );
      battery.addEventListener("levelchange", this.onLevelChange(9));
    });
  },
  methods: {
    handleChange(change) {
      this.timeBadge = new Date().toTimeString().split(" ")[0];
      this.change = change;
    },

    onChargingChange() {
      console.log("onChargingChange");
    },
    onChargingTimeChange() {
      console.log("onChargingTimeChange");
    },
    onDischargingTimeChange() {
      console.log("onDischargingTimeChange");
    },
    onLevelChange() {
      console.log("onLevelChange");
    }
  }
};
</script>

<style>
</style>
