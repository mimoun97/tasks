<template>
  <span>
    <task-create :users="dataUsers"></task-create>
    <task-list :tasks="dataTasks" :tags="dataTags" :users="dataUsers" :uri="uri"></task-list>
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
    
  }
};
</script>
