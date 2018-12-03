export default {
    methods: {
        data () {
            return {
                snackbarMessage: 'Prova',
                snackbarTimeout: 3000,
                snackbarColor: 'succes',
                snackbar: false,
            }
        },
        // SNACKBAR
        showMessage (message) {
            this.snackbarMessage = message
            this.snackbarColor = 'success'
            this.snackbar = true
        },
        showError (error) {
            this.snackbarMessage = error
            this.snackbarColor = 'error'
            this.snackbar = true
        }
    }
}
