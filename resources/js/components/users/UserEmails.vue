<template>
  <v-menu offset-y>
    <v-tooltip bottom slot="activator">
      <v-btn
        slot="activator"
        @click="sendMail(user)"
        :loading="loading"
        :disabled="loading"
        color="primary"
        class="white--text"
        aria-label="Enviar Emails"
      >
        <v-icon>email</v-icon>
      </v-btn>
      <span>Enviar emails</span>
    </v-tooltip>
    <v-list>
      <v-list-tile @click="reset">
        <v-list-tile-title>Password reset</v-list-tile-title>
      </v-list-tile>
      <v-list-tile @click="confirm">
        <v-list-tile-title>Email confirmation</v-list-tile-title>
      </v-list-tile>
    </v-list>
  </v-menu>
</template>

<script>
export default {
  name: "UserEmails",
  data() {
    return {
      loading: false,
      email: null
    };
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  methods: {
    confirm() {
      this.loading = true;
      window.axios
        .get("/email/resend")
        .then(response => {
          this.loading = false;
          this.$snackbar.showMessage("Email de confirmació enviat");
        })
        .catch(() => {
          this.loading = false;
        });
    },
    reset() {
      this.loading = true;
      window.axios
        .post("/password/" + this.user.email)
        .then(response => {
          console.log(this.user.email);
          this.loading = false;
          this.$snackbar.showMessage(
            "Email per restaurar la paraula de pas enviat"
          );
        })
        .catch(() => {
          this.loading = false;
          this.$snackbar.showError("Email per restaurar la paraula de pas no enviat");
        });
    }
  }
};
</script>
