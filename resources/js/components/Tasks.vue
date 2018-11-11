<template>
    <v-container grid-list-md text-xs-center id="tasks" class="tasks">
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
        { 'name' : 'comprar pa',
            'completed' : false},
        { 'name' : 'comprar oli',
            'completed' : false},
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
