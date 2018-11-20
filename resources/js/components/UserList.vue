<template>
    <v-list two-line>
        <template v-for="user in dataUsers">
            <v-list-tile >
                <v-list-tile-avatar>
                    <v-avatar :title="user.name">
                        <img :src="user.avatar" :alt="user.name">
                    </v-avatar>
                </v-list-tile-avatar>
                <v-list-content>
                    <v-list-tile-title> {{ user.name }}</v-list-tile-title>
                    <v-list-tile-sub-title>{{ user.email }}</v-list-tile-sub-title>
                </v-list-content>
            </v-list-tile>
        </template>
    </v-list>
</template>

<script>
    export default {
        name: "UserList",

        data () {
            return {
                dataUsers: this.user
            }
        },
        props : {
            users: {
                type: Array,
            }
        },
        created () {
            if (this.users) this.dataUser = this.users
            else {
                window.axios('/api/v1/users').then(response => {
                    this.dataUsers = response.data
                }).catch(error => {
                    console.log(error)
                    //this.snackbar.showErroMessage
                })
            }
        }
    }
</script>

<style scoped>

</style>
