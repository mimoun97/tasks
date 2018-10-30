<template>

</template>

<script>

    import { validationMixin } from 'vuelidate'
    import { required, maxLength } from 'vuelidate/lib/validators'

    export default {
        name: "LoginForm",
        mixins: [validationMixin],
        validations: {
          email: { required, email },
          password: { required, minLength: minLength(6) }
        },
        data () {
            return {

            }
        },
        props: ['email', 'csrf-token']
    }

</script>

<style scoped>

</style>
