<template>
  <v-card dark color="cyan lighten-3">
    <v-layout align-center row wrap>
      <v-flex xs2>
        <v-avatar size="54" color="white">
          <v-icon color="cyan lighten-3" size="28">notifications_off</v-icon>
        </v-avatar>
      </v-flex>
      <v-flex xs10>
        <v-card-text class="grey--text text--darken-2">
        <p class="title">Recibe notificaciones de mensajes nuevos</p> 
          <p class="body pointer underline" @click="dialog = true">Activar notificacions d'escriptori ></p>
          <p></p>
        </v-card-text>
      </v-flex>
    </v-layout>
    <notifications-full-screen v-model="dialog"></notifications-full-screen>
  </v-card>
</template>

<script>
import NotificationsFullScreen from './NotificationsFullScreen.vue'

export default {
  name: "NotificationsActivateButton",
  components: {
    'notifications-full-screen': NotificationsFullScreen
  },
  data() {
    return {
      dialog: false
    };
  },
};
</script>

<style scoped>
.pointer {
  cursor: pointer;
}
.underline {
    text-decoration: underline
}
</style>
