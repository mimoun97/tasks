<template>
  <div>        
    <v-container grid-list-md text-xs-center id="tasks" class="tasks">
        <v-toolbar color="blue darken-3">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile>
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile>
                        <v-list-tile-title>Opcuió 2</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text">
                <v-icon>refresh</v-icon>
            </v-btn>
  </v-toolbar>
        <v-card>
            <v-card-title dark color="primary">
                <span class="title">Tasques ({{total}})</span>
            </v-card-title>
            <v-card-text>
              <v-list dense>
                            <v-list-tile v-for="task in dataTasks" :key="task.name">
                                <v-list-tile-content>
                                    <v-list-tile-title>
                                       {{task.name}}
                                    </v-list-tile-title>
                                    
                                </v-list-tile-content>
                            </v-list-tile>
                        </v-list>
            </v-card-text>
            <v-card-text class="px-0">
              TODO filtros
            </v-card-text>
        </v-card>
    </v-container>
  </div>
</template>

<script>
    export default {
  name: 'Tasks',
  components: {
  },
  data () {
    return {
      filter: 'all', // All Completed Active
      newTask: '',
      dataTasks: [
        { 'name' : 'Comprar pa',
            'completed' : false},
        { 'name' : 'Comprar oli',
            'completed' : true},
        { 'name' : 'Estudair PHP',
            'completed' : false}
      ],
      errorMessage: ''
    }
  },
  props: {
    tasks: {
      type: Array,
      default: function () {
        return []
      }
    }
  },
  computed: {
        total () {
            return this.dataTasks.length
        }
    }
    }
</script>
