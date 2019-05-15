<template>
  <v-layout>
    <v-flex style="display: flex;align-items: center;">
      <v-tooltip left>
        <v-btn slot="activator" v-if="disabled" icon flat color="primary" href="#" target="_blank">
          <v-icon>help</v-icon>
        </v-btn>
        <span>Ajuda sobre les notificacions</span>
      </v-tooltip>
      <v-tooltip left>
        <v-switch
          slot="activator"
          color="primary"
          v-model="notificationEnabled"
          label="Notificacions"
          :loading="loading"
          :disabled="disabled || loading"
        ></v-switch>
        <span
          v-if="disabled"
        >No heu permès les notificacions per aquest lloc. Feu click a l'icona d'ajuda per veure com podeu reactivar les notificacions.</span>
        <span v-else>
          Notificacions
          <span v-if="notificationEnabled">activades</span>
          <span v-else>desactivades</span>
        </span>
      </v-tooltip>
    </v-flex>
    <v-flex>
      <v-btn
        v-if="!disabled"
        :loading="sending"
        :disabled="sending"
        @click="sendNotification"
      >Send Notification</v-btn>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  name: "PushNotificationsButton",
  data() {
    return {
      notificationEnabled: false,
      loading: false,
      sending: false,
      disabled: false,
      disableWatcher: false
    };
  },
  methods: {
    requestPermission() {
      if (!("Notification" in window)) {
        alert("Notification API not supported!");
        return;
      }

      Notification.requestPermission(result => {
        console.log("RESULT:", result);
        if (permission !== "granted") {
          // no notifications
          this.notificationEnabled = false;
          this.disabled = true;
        } else {
          // yes notifications
          this.notificationEnabled = true;
          this.disabled = false;
        }
      });
    },
    sendNotification() {
      this.sending = true;

      window.axios
        .post("/api/v1/simple_notifications/", {
          user: window.laravel_user.id,
          title: "Hola desde Vue!"
        })
        .catch(() => {
          this.sending = false;
          this.$snackbar.showInfo("Notificació enviada!");
        })
        .then(() => {
          this.sending = false;
          this.$snackbar.showError("Error: ", error);
        });
    },
    subscribe() {
      //TODO subscribe
      console.log("SUBSCRIBE push");
    },
    unsubscribe() {
      //TODO unsubscribe
      console.log("SUBSCRIBE push");
    },
    /**
     * Toggle push notifications subscription.
     */
    togglePush(oldValue) {
      this.loading = true;
      if (oldValue) {
        console.log("UNSUBSCRIBING...");
        this.unsubscribe();
      } else {
        console.log("SUBSCRIBING...");
        this.subscribe();
      }
    },
    watch: {
      notificationEnabled(notificationEnabled, oldValue) {
        console.log("HOLA watch");
        if (!this.disableWatcher) this.togglePush(oldValue);
      }
    },
    mounted() {
      requestPermission();
      window.eventBus.$on("pushDisabled", () => {
        console.log("Received event pushDisabled");
        this.disabled = true;
      });
      window.eventBus.$on("pushEnabled", () => {
        console.log("Received event pushEnabled");
        this.disabled = false;
      });
      window.eventBus.$on("enableNotifications", () => {
        console.log("Received event enableNotifications");
        this.disableWatcher = true;
        this.notificationEnabled = true;
        this.disableWatcher = false;
      });
      window.eventBus.$on("disableNotifications", () => {
        this.disableWatcher = true;
        this.notificationEnabled = false;
        this.disableWatcher = false;
      });
      window.eventBus.$on("pushOperationFinished", () => {
        this.loading = false;
      });
    }
  }
};
</script>