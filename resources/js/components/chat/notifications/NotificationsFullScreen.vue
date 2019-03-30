<template>
  <v-layout align-center justify-center row fill-height>
    <v-flex>
      <v-dialog v-model="dataShow" fullscreen transition="dialog-bottom-transition">
        <v-card color="rgb(0, 0, 0, 0.85)">
          <v-layout fill-height padding layout-justify-center align-center row>
            <v-flex xs3>
                <v-avatar size="54" color="rgb(120, 120, 120, 0.8)">
                  <v-icon color="white" size="28">arrow_upward</v-icon>
                </v-avatar>
              </v-flex>
            <v-flex xs9>
              
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
      dataShow: true
    };
  },
  model: {
    prop: "dataShow",
    event: "input"
  },
  props: {
    show: {
      Type: Boolean,
      default: null
    }
  },
  watch: {
    show(newval) {
      this.$emit("input", newval);
    },
    dataShow(newVal) {
      console.log(newVal);
      this.show = newVal;
    }
  }
};
</script>

<style>
</style>
