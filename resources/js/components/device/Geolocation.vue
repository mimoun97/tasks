<template>
  <v-card flat>
    <v-card-title class="title">Geolocation</v-card-title>
    <v-card-text>
      <p class="grey--text text--lighten-1 body-1">
        The Geolocation API lets authorized Web applications to access the location data provided by
        the device - obtained using either GPS or from the network environment. Apart from the one-off
        location query, it gives a way for the app to be notified about the location changes.
      </p>
      <p class="grey--text text--lighten-1 body-1">
        Per a <b>simular la ubicació en chrome</b> entra a developer tools al menú de la dreta <b>More tools</b>
        entra a <b>Sensors</b> i a l'apartat <b>Geolocation</b> pots triar la ubicació que vols i mira com s'actualitza
        l'ubicació.
      </p>
      <p class="grey--text text--lighten-1 body-1">
        Si vols que l'applicació rastreji la teva ubicació clica al boto <span class="red--text">STOP WTCHING MY LOCATION</span>
      </p>
      <p>
        Latitud:
        <b>{{location.lati}}</b>
      </p>
      <p>
        Longitud:
        <b>{{location.long}}</b>
      </p>
      <p v-if="message" v-text="message" class="red--text"></p>
    </v-card-text>
    <v-card-actions class="justify-center">
      <v-btn
        @click="getCurrentPosition()"
        color="blue-grey"
        class="white--text"
        :loading="working"
      >Ask for location
        <v-icon right dark color="white">my_location</v-icon>
      </v-btn>
      <v-btn
        @click="destroyLocation()"
        color="red"
        class="white--text"
        :loading="working"
      >Stop watching my location!
        <v-icon right dark color="white">stop</v-icon>
      </v-btn>
    </v-card-actions>
  </v-card>
</template>

<script>
export default {
  name: "Geolocation",
  data() {
    return {
      location: {
        lati: "no latitude",
        long: "no longitude"
      },
      message: null,
      watchID: null,
      working: false
    };
  },
  methods: {
    getCurrentPosition() {
      this.working = true;
      if ("geolocation" in navigator) {
        navigator.geolocation.getCurrentPosition(location => {
          this.location.lati = location.coords.latitude;
          this.location.long = location.coords.longitude;
        });
      } else {
        this.message = "Geolocation API not supported.";
      }
      this.working = false;
    },
    updateLocation() {
      if (!this.watchID) return;
      this.getCurrentPosition();
    },
    destroyLocation() {
      if (this.watchID) {
        navigator.geolocation.clearWatch(this.watchID);
        this.watchID = null
      }
    }
  },
  created() {
    if ("geolocation" in navigator) {
      // TODO watch longitude
      this.watchID = navigator.geolocation.watchPosition(() =>
        this.updateLocation()
      );
    }
  },
  beforeDestroy() {
    this.destroyLocation();
  }
};
</script>

<style>
</style>
