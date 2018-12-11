<template>
    <user-select :users="dataUsers"></user-select>

</template>

<script>
    import UserSelect from './UserSelect'
    export default {
        name: "Impersonate",
        components: {
          'user-select': UserSelect
        },

        data() {
            return {
                label: {

                }
            }
        },
        props: {
            users: {
                type: Array,
                required: true
            },
            url: {
                type: String,
                required: '/api/v1/users'
            },
            label: {
                type: String,
                required: 'Usuaris'
            }
        }
    }
</script>

<style scoped>

</style>
