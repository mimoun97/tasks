<template>
    <v-form>
        <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>
        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

        <v-textarea v-model="description" label="Descripció" hint="Escriu la descripció de la tasca..."></v-textarea>
        <user-select v-model="user" :users="dataUsers" label="Usuari" @selected="updateUser"></user-select>
        <div class="text-xs-center">
            <v-btn @click="$emit('close')">
                <v-icon class="mr-1">exit_to_app</v-icon>
                Cancel·lar
            </v-btn>
            <v-btn color="success" @click="add">
                <v-icon class="mr-1" >save</v-icon>
                Afegir
            </v-btn>
        </div>
    </v-form>
</template>

<script>
    export default {
        name: 'TaskForm',
        data () {
            return {
                name: '',
                completed: false,
                description: '',
                dataUsers: this.users,
                loading: false,
                user_id: null
            }
        },
        props: {
            users: {
                type: Array,
                required: true
            },
            uri: {
                type: String,
                default: '/api/v1/tasks'
            }
        },
        methods: {
            updateUser(user) {
                this.user = user
                this.user_id = user.id
                console.log(this.user)
            },
            reset() {
                this.task = {
                    'name': '',
                    'description': '',
                    'completed': '',
                    'user_id': null
                }
            },
            add () {
                this.loading = true
                const task = {
                    'name': this.name,
                    'description': this.description,
                    'completed': this.completed,
                    'user_id': this.user_id
                }
                window.axios.post(this.uri, task).then(response => {
                    this.$snackbar.showMessage('Tasca creada correctament')
                    this.$emit('created', response.data)
                    this.loading = false
                    reset();
                    this.$emit('close')
                }).catch(error => {
                    this.$snackbar.showError(error.data)
                    this.loading = false
                })
            }
        }
    }
</script>
