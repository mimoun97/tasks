<template>
	<div id="app">
  <v-app id="inspire">
    <v-snackbar :timeout="3000" color="success" v-model="snackbar">
      Això és un snackbar
      <v-btn dark flat @click="toggle" >Close </v-btn>
    </v-snackbar>
    <v-toolbar color="blue">
      <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile @click="opcio1">
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://google.com">
                        <v-list-tile-title>Google</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
      <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
      <v-spacer></v-spacer>
        <v-btn icon class="white--text">
          <v-icon>settings</v-icon>
         </v-btn>
         <v-btn icon class="white--text" @click="refresh">
                <v-icon>refresh</v-icon>
         </v-btn>
    </v-toolbar>
    
    <v-card>
          <v-data-table
      :headers="headers"
      :items="dataTasks"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.name }}</td>
        <td>{{ props.item.created_at }}</td>
        <td>{{ props.item.updated_at }}</td>
        <td>{{ props.item.user_id }}</td>
        <td>{{ props.item.completed }}</td>
        <td>
          <v-btn icon color="primary" flat title="Mostrar snackbar"
                                   @click="toggle">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="primary" flat title="Mostrar la tasca"
                                   @click="show(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Canviar la tasca"
                                   @click="update(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-btn icon color="error" flat title="Eliminar la tasca"
                                    @click="destroy(task)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                            <v-switch :label="completed ? 'completada' : 'pendent'" v-model="completed"
   							 ></v-switch>
         </td>
      </template>
    </v-data-table>
    </v-card>
    <v-btn
            @click="showCreateDialog"
            fab
            bottom
            right
            fixed
            color="pink"
            class="white--text"
        >
            <v-icon>add</v-icon>
        </v-btn>
                               
        <v-dialog
      v-model="dialog"
      max-width="290"
    >
      <v-card>
        <v-card-title class="headline">Voleu tancar?</v-card-title>

        <v-card-text>
          Esteu segur que volew eliminar la tasca.
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn
            color="green darken-1"
            flat="flat"
            @click="dialog = false"
          >
            Disagree
          </v-btn>

          <v-btn
            color="green darken-1"
            flat="flat"
            @click="dialog = false"
          >
            Agree
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-app>
</div>
</template>

<script>
export default {

  name: 'Tasques',

  data() {
    return {
    	dialog: false,
      snackbar: true,
      headers: [
        {
          text: 'Nom',
          align: 'left',
          sortable: false,
          value: 'name'
        },
        { text: 'Creació', value: 'created_at' },
        { text: 'Modificació', value: 'updated_at' },
        { text: 'IdUsuari', value: 'user_id' },
        { text: 'Completada', value: 'completed' },
        { text: 'Accions', sortable: false }
      ],
      dataTasks: [
        {
          id: 1,
          name: 'Comprar pa',
          completed: false,
          user_id: 1,
          created_at: 'fa 1 minut',
          updated_at: 'fa 1 minut'
        },
        {
          id: 2,
          name: 'Comprar llet',
          completed: false,
          user_id: 1,
          created_at: 'fa 1 minut',
          updated_at: 'fa 1 minut'
        },
        {
          id: 3,
          name: 'Estudiar PHP',
          completed: true,
          user_id: 2,
          created_at: 'fa 1 minut',
          updated_at: 'fa 1 minut'
        }
      ]
    };
  },
  methods: {
    toogle () {
        this.snackbar = !this.snackbar;
    },
    showDialog () {
      this.dialog = !this.dialog;
    },
    showCreateDialog() {
      this.dialog = !this.dialog;
    }
}
};
</script>

<style lang="css" scoped>
</style>
