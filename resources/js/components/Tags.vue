<template>
    <div>
        <v-btn @click="showMessage" >Hola</v-btn>
        <v-btn @click="showError" >Adeu</v-btn>
    </div>
</template>

<script>
    import HasSnackbar from "./mixins/HasSnackbar";

    export default {
        name: "Tags",
        mixins: [HasSnackbar],
        data (){
            return {

            }
        },
        methods: {
            showMessage () {
                console.log('blablasdas')
                this.$snackbar.showMessage('Missatge exemple')
            },
            showError () {
                console.log('adeu')
                this.$snackbar.showError('Missatge error')
            }
        }
    }
</script>
