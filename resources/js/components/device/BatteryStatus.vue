<template>
  <div>
    <p class="title">Battery Status</p>
    <p>
      Initial battery status was
      <b v-text="battery.charging||'unknown'"></b>
    </p>
    <p>, charging time</p>
    <p>
      Discharging time
      <b v-text="battery.chargingTime||'unknown'"></b>
    </p>
    <p>
      <b v-text="battery.dischargingTime||'unknown'"></b>, level
    </p>
    <p>
      <b v-text="battery.level||'unknown'"></b>.
    </p>

    <div id="target"></div>
  </div>
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

    batteryPromise.then(function(battery) {
      this.battery = battery;

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
