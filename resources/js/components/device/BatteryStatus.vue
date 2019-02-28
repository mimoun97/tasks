<template>
  <div>
    <p class="title">Battery Statuss</p>
    <p>Initial battery status was
      <b v-text="battery.charging||'unknown'"></b>, charging time
      <b v-text="battery.chargingTime||'unknown'"></b>, discharging time
      <b v-text="battery.dischargingTime||'unknown'"></b>, level
      <b v-text="battery.level||'unknown'"></b>.
    </p>

    <div id="target"></div>
  </div>
</template>

<script>
export default {
  name: "BatteryStatus",
  data: function () {
    return {
      batteryPromise: {},
      timeBadge: null,
      battery: {},
      change: null
    };
  },
  created() {
    if (
      "getBattery" in navigator ||
      ("battery" in navigator && "Promise" in window)
    ) {
      if ("getBattery" in navigator) {
        this.batteryPromise = navigator.getBattery();
      } else {
        this.batteryPromise = Promise.resolve(navigator.battery);
      }
    }

    this.batteryPromise.then(function(battery) {
      this.battery = battery

      battery.addEventListener("chargingchange", this.onChargingChange);
      battery.addEventListener("chargingtimechange", this.onChargingTimeChange);
      battery.addEventListener(
        "dischargingtimechange",
        this.onDischargingTimeChange
      );
      battery.addEventListener("levelchange", this.onLevelChange);
    });
  },
  methods: {
    handleChange(change) {
      this.timeBadge = new Date().toTimeString().split(" ")[0];
      this.change = change;
    },

    onChargingChange() {},
    onChargingTimeChange() {},
    onDischargingTimeChange() {},
    onLevelChange() {}
  }
};
</script>

<style>
</style>
