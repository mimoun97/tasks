<template>
  <span>
    <v-tooltip bottom slot="activator">
      <v-btn
        slot="activator"
        @click="sendSMS"
        :loading="loading"
        color="primary"
        round
        class="white--text"
        aria-label
      >
        <v-icon>sms</v-icon>
      </v-btn>
      <span>Enviar codi SMS</span>
    </v-tooltip>
    <v-tooltip bottom slot="activator">
      <mobile-verification-form slot="activator" :user="user"></mobile-verification-form>
      <span>Enter codi here</span>
    </v-tooltip>
  </span>
</template>

<script>
import MobileVerificationForm from "./MobileVerificationForm";

export default {
  data() {
    return {
      loading: false
    };
  },
  components: {
    "mobile-verification-form": MobileVerificationForm
  },
  props: {
    user: {
      type: Object,
      required: true
    }
  },
  methods: {
    sendSMS() {
      // TODO sendSMS
      this.loading = true;
      window.axios
        .post("/api/v1/users/" + this.user.id + "/send_mobile_verification")
        .then(response => {
          this.loading = false;
          this.$snackbar.showMessage("SMS enviado");
        })
        .catch(() => {
          this.loading = false;
          this.$snackbar.showError("SMS no enviado");
        });
    }
  }
};
</script>

<style>
</style>
