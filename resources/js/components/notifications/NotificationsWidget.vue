<template>
  <v-menu offset-y>
    <v-badge slot="activator" left overlap color="red lighten-2" class="ml-3 mr-2 mt-2">
      <span slot="badge" v-text="amount"></span>
      <v-btn icon color="white" :loading="loading" :disabled="loading" aria-label="Notifications">
        <v-icon :large="large" color="primary">notifications</v-icon>
      </v-btn>
    </v-badge>
    <v-list>
      <v-list-tile v-if="dataNotifications.length > 0">
        <v-list-tile-title>
          <span
            v-if="dataNotifications.length === 1"
          >Teniu {{ dataNotifications.length }} notificació pendent:</span>
          <span v-else>Teniu {{ dataNotifications.length }} notificacións pendents:</span>
        </v-list-tile-title>
      </v-list-tile>
      <v-divider v-if="dataNotifications.length > 0"></v-divider>
      <v-list-tile
        v-if="dataNotifications.length > 0"
        v-for="(notification, index) in dataNotifications"
        :key="index"
        @click="markAsReaded(notification)"
      >
        <v-list-tile-title
          style="max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
        >{{ notification.data.title }}</v-list-tile-title>
      </v-list-tile>
      <v-card v-if="dataNotifications.length === 0" flat>
        <v-layout align-center column class="text-xs-center">
          <v-avatar color="grey lighten-4" size="56" class="mb-2">
            <v-icon color="grey lighten-1" style="font-size: 36px;">done_all</v-icon>
          </v-avatar>
          <h3 class="grey--text text--darken-2 mx-2">No hi ha cap notificació pendent</h3>
          <p
            class="grey--text text--lighten-1 mb-2 font-weight-light"
            style="text-overflow: ellipsis;"
          >Molt bé! Estàs al dia.</p>
        </v-layout>
      </v-card>
      <v-divider></v-divider>
      <v-list-tile>
        <v-list-tile-title class="caption">
          <a href="/notifications">Veure totes</a> |
          <span v-if="dataNotifications.length > 0">
            <a href="#" @click="markAllAsReaded">Marcar totes com a llegides</a> |
          </span>
          <a href="#" @click="refresh(true)">Actualitzar</a>
        </v-list-tile-title>
      </v-list-tile>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  name: "NotificationsWidget",
  data() {
    return {
      dataNotifications: [],
      loading: false
    };
  },
  props: {
    notifications: {
      type: Array,
      required: false
    }
  },
  computed: {
    large() {
      if (this.dataNotifications) return this.dataNotifications.length > 0;
      return false;
    },
    amount() {
      if (this.dataNotifications) return this.dataNotifications.length;
      return 0;
    }
  },
  methods: {
    refresh(message = false) {
      this.loading = true;
      window.axios
        .get("/api/v1/user/unread_notifications/")
        .then(response => {
          this.dataNotifications = response.data;
          this.loading = false;
          if (message)
            this.$snackbar.showMessage(
              "Notificacions actualitzades correctament"
            );
        })
        .catch(error => {
          this.loading = false;
          this.$snackbar.showError(error);
        });
    },
    markAsReaded(notification) {
      this.loading = true;
      window.axios
        .delete("/api/v1/user/unread_notifications/" + notification.id)
        .then(() => {
          this.loading = false;
          this.refresh();
        })
        .catch(error => {
          this.loading = false;
          this.$snackbar(error);
        });
    },
    markAllAsReaded() {
      this.loading = true;
      this.loading = true;
      window.axios
        .delete("/api/v1/user/unread_notifications/all")
        .then(() => {
          this.loading = false;
          this.refresh();
        })
        .catch(error => {
          this.loading = false;
          this.$snackbar(error);
        });
    }
  },
  created() {
    if (this.notifications) {
      this.dataNotifications = this.notifications;
    } else {
      this.loading = true;
      window.axios
        .get("/api/v1/user/unread_notifications")
        .then(response => {
          this.dataNotifications = response.data;
          this.loading = false;
        })
        .catch(error => {
          this.$snackbar.showError(error);
          this.loading = false;
        });
    }
  }
};
</script>
