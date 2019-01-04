<template>
    <span>
        <v-dialog v-model="deleteDialog">
            <v-card>
                <v-card-title class="headline">Esteu segurs?</v-card-title>

                <v-card-text>
                    Aquesta operació no es pot desfer.
                </v-card-text>

                <v-card-actions>
                    <v-spacer></v-spacer>
                      <v-btn
                              color="green darken-1"
                              flat="flat"
                              @click="deleteDialog = false"
                      >
                        Cancel·lar
                      </v-btn>

                      <v-btn
                              color="error darken-1"
                              flat
                              @click="destroy"
                              :loading="removing"
                              :disabled="removing"
                      >
                        Confirmar
                      </v-btn>
        </v-card-actions>
        </v-card>
        </v-dialog>

        <v-dialog v-model="editDialog" fullscreen hide-overlay transition="dialog-bottom-transition"
                  @keydown.esc="editDialog=false">
            <v-toolbar color="blue darken-3" class="white--text">
                <v-btn flat icon class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1">close</v-icon>
                </v-btn>
                <v-toolbar-title class="white--text">Editar Tasca</v-toolbar-title>
                <v-spacer></v-spacer>
                <v-btn flat class="white--text" @click="editDialog=false">
                    <v-icon class="mr-1">exit_to_app</v-icon>
                    Sortir
                </v-btn>
                <v-btn flat class="white--text">
                    <v-icon class="mr-1">save</v-icon>
                    Guardar
                </v-btn>
            </v-toolbar>
            <v-card>
                <v-card-text>
                    <v-form>
                        <v-text-field v-model="name" label="Nom" hint="El nom de la tasca..." placeholder="Nom de la tasca"></v-text-field>
                        <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

                        <v-textarea v-model="description" label="Descripció" hint="bla bla bla..."></v-textarea>
                        <v-autocomplete :items="dataUsers" label="Usuari" item-text="name"></v-autocomplete>
                        <div class="text-xs-center">
                            <v-btn @click="editDialog=false">
                                <v-icon class="mr-1">exit_to_app</v-icon>
                                Cancel·lar
                            </v-btn>
                            <v-btn color="success" @click="update">
                                <v-icon class="mr-1" >save</v-icon>
                                Guardar
                            </v-btn>
                        </div>
                    </v-form>
                </v-card-text>
            </v-card>
        </v-dialog>

        <task-create :users="dataUsers" :created="refresh()"></task-create>

        <!--//TODO component tasks-list-->

        <task-list></task-list>

        <!--//TODO component task-destroy-->
        <task-destroy :uri="uri"></task-destroy>

        <!--//TODO component task-update-->
        <task-update :uri="uri"></task-update>
    </span>
</template>

<script>
import TaskCompletedToggle from './TaskCompletedToggle'
import Toggle from './Toggle'
import TaskCreate from './TaskCreate'
import TaskList from './TaskList'
import TaskDestroy from './TaskDestroy'
import TaskUpdate from './TaskUpdate'

export default {
  name: 'Tasques',
  components: {
    'task-completed-toggle': TaskCompletedToggle,
    'toggle': Toggle,
    'task-create': TaskCreate,
    'task-list': TaskList,
    'task-destroy': TaskDestroy,
    'task-update': TaskUpdate
  },
  data () {
    return {
      dataUsers: this.users,
      completed: false,
      name: '',
      description: '',
      editDialog: false,
      deleteDialog: false,
      user: '',
      usersold: [
        'Sergi Tur',
        'Pepe Pardo',
        'Maria Delahoz'
      ],
      filter: 'Totes',
      filters: [
        'Totes',
        'Completades',
        'Pendents'
      ],
      search: '',
      pagination: {
        rowsPerPage: 25
      },
      loading: false,
      creating: false,
      editing: false,
      removing: null,
      dataTasks: this.tasks,
      headers: [
        { text: 'Id', value: 'id' },
        { text: 'Name', value: 'name' },
        { text: 'User', value: 'user_id' },
        { text: 'Completat', value: 'completed' },
        { text: 'tags', value: 'tags.name' },
        { text: 'Creat', value: 'created_at_human.' },
        { text: 'Modificat', value: 'updated_at_human' },
        { text: 'Accions', sortable: false, value: 'full_search' }
      ]
    }
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    showUpdate () {
      this.editDialog = true
    },
    opcio1 () {
      console.log('OPCIO 1 REFRESH')
    },
    removeTask (task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1)
    },
    // destroyWithPromises () {
    //   this.$confirm().then(
    //     // Ok tirem endavant
    //     window.axios.then(
    //       window.axios.then(
    //     ).catch
    //   ).catch(
    //     // No fer res
    //   )
    // },
    async destroy (task) {
      // ES6 async await
      let result = await this.$confirm('Les tasques esborrades no es poden recuperar',
        {
          title: 'Esteu segurs?',
          buttonTruetext: 'Eliminar',
          buttonFalsetext: 'Cancel·lar',
          // icon: '',
          color: 'error'
        })
      if (result) {
        this.removing = task.id
        window.axios.delete(this.uri + '/' + task.id).then(() => {
          // this.refresh() // Problema -> rendiment
          this.removeTask(task)
          this.deleteDialog = false
          task = null
          this.$snackbar.showMessage("S'ha esborrat correctament la tasca")
          this.removing = null
        }).catch(error => {
          this.$snackbar.showError(error.message)
          this.removing = null
        })
      }
    },
    create (task) {
      console.log('TODO CREATE TASK')
    },
    update (task) {
      console.log('TODO UPDATE TASK ' + task.id)
    },
    show (task) {
      console.log('TODO SHOW TASK ' + task.id)
    },
    refresh () {
      // this.loading = true
      window.axios.get(this.uri).then(response => {
        this.dataTasks = response.data
        this.loading = false
        this.refresh()
        this.$snackbar.showMessage('Tasques actualitzades correctament')
      }).catch(error => {
        console.log(error)
        this.loading = false
      })
    }
  }
}
</script>
