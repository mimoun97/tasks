<template>
    <v-snackbar :timeout="timeout" :color="color" v-model="show">
        {{ message }}
        <v-btn dark flat @click="show=false">Tancar</v-btn>
    </v-snackbar>
</template>

<script>
export default {
  data () {
    return {
      message: 'Prova',
      timeout: 3000,
      color: 'success',
      show: false
    }
  },
  methods: {
    showMessage (message) {
      this.message = message
      this.color = 'success'
      this.show = true
    },
    showError (error) {
      this.message = error
      this.color = 'error'
      this.show = true
    }
  },
  mounted () {
      this.$snackbar.showError('showSnackbarError')
      this.$snackbar.showMessage('showSnackbarMessage')
  }
}
</script>
