<template>
  <v-layout align-center justify-center row fill-height>
    <v-flex>
      <v-dialog v-model="dataShow" fullscreen transition="dialog-bottom-transition" full-width>
        <v-card color="rgb(0, 0, 0, 0.85)" class="parent">
          <v-layout align-center justify-center row fill-height>
            <div class="child">
              <v-flex xs3 offset-xs2>
                <v-avatar size="54" color="rgb(120, 120, 120, 0.8)">
                  <v-icon color="white" size="28" class="icon__flip">call_made</v-icon>
                </v-avatar>
              </v-flex>
              <v-flex xs9 offset-xs2>
                <v-card-title class="headline white--text">
                  <p>Permitir notificaciones</p>
                </v-card-title>

                <v-card-text class="grey--text text--lighten-2 subhead">
                  <h5>Haz clic en "Permitir" arriba para recibir notificaciones de mensajes nuevos.</h5>
                </v-card-text>
                <v-card-actions>
                  <v-btn class="white--text" color="#38c75cff" @click="dataShow = false">OK</v-btn>
                </v-card-actions>
              </v-flex>
            </div>
          </v-layout>
        </v-card>
      </v-dialog>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: "NotificationsFullScreen",
  data() {
    return {
      showing: false,
      granted: false
    };
  },
  methods: {
    requestPermission() {
      this.showing = true
      Notification.requestPermission().then((result) => {
        if (result === "denied") {
          console.log("Permission wasn't granted. Allow a retry.");
          this.showing = false
          this.granted = false
          return;
        }
        if (result === "default") {
          console.log("The permission request was dismissed.");
          this.showing = false
          return;
        }
        // Do something with the granted permission.
        this.granted = true
      });
    },
    hasPermission() {
      return this.granted
    }
  }
};
</script>

<style scoped>
.icon__flip {
  -moz-transform: scaleX(-1);
  -o-transform: scaleX(-1);
  -webkit-transform: scaleX(-1);
  transform: scaleX(-1);
  filter: FlipH;
  -ms-filter: "FlipH";
}
.parent {
  position: relative;
}
.child {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}
</style>
