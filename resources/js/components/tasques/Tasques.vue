<template>
  <v-layout>
    <task-create :users="dataUsers" @created="add" :uri="uri"></task-create>
    <task-list v-if="noZeroTasks" :tasks="dataTasks" :tags="dataTags" :users="dataUsers" :uri="uri"></task-list>

    <empty-state
      v-else
      label="Crea la teva primera tasca!"
      icon="description"
      description="Si creeu una tasca, podreu afegir etiquetes i col·laborar amb les persones."
    ></empty-state>
  </v-layout>
</template>

<script>
import TaskCreate from "./TaskCreate";
import TaskList from "./TaskList";
import EmptyState from "../ui/EmptyState";

export default {
  name: "Tasques",
  components: {
    "task-create": TaskCreate,
    "task-list": TaskList
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
    add(task) {
      this.dataTasks.push(task);
    }
  },
  computed: {
    noZeroTasks: function() {
      // `this` points to the vm instance
      //console.log('HOLA TRUE?' + this.dataTasks.length)
      return this.dataTasks.length !== 0;
    }
  }
};
</script>
