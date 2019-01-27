<template>
  <span>
    <task-create :users="dataUsers"></task-create>
    <task-list v-if="noZeroTasks" :tasks="dataTasks" :tags="dataTags" :users="dataUsers" :uri="uri"></task-list>
    <div v-else>
      <v-card dark flat
    class="mx-auto"
    color="grey lighten-4"
    max-width="400"
  >
    <v-card-title>
    </v-card-title>

    <v-card-text class="grey--text lkighten-4 headline font-weight-bold">
      Cap tasca encara
    </v-card-text>

    <v-card-actions>
      <v-list-tile class="grow">
        <v-list-tile-content>
          <v-btn raised flat color="primary">Afegir</v-btn>   
        </v-list-tile-content>
      </v-list-tile>
    </v-card-actions>
  </v-card>
    </div>
    
  </span>
</template>

<script>
import TaskCreate from "./TaskCreate";
import TaskList from "./TaskList";

export default {
  name: "Tasques",
  components: {
    "task-create": TaskCreate,
    "task-list": TaskList,
  },
  data() {
    return {
      dataUsers: this.users,
      dataTasks: this.tasks,
      dataTags: this.tags
    };
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    tags: {
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
    
  },
  computed: {
    noZeroTasks: function () {
      // `this` points to the vm instance
      //console.log('HOLA TRUE?' + this.dataTasks.length)
      return this.dataTasks.length !== 0
    }
  }
};
</script>
