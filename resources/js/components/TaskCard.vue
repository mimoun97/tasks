<template>
  <v-card class="my-1">
    <v-card-title primary-title class="title grey--text text--darken-1 my-2" v-text="dataTask.name"></v-card-title>
    <v-card-text class="content grey--text text--darken-4 my-2" v-text="dataTask.description"></v-card-text>
    <v-card-text class>
      <task-completed-toggle :task="dataTask"></task-completed-toggle>
    </v-card-text>
    <v-card-actions class="hidden-xs">
      <v-layout column class="ml-3 mb-2">
        <v-flex xs12 md12>
          <v-avatar size="48px" color="grey lighten-3">
            <picture>
              <source :srcset="dataTask.user_gravatar+'?s=48.webp'" type="image/webp">
              <img v-if="dataTask.user_gravatar" :src="dataTask.user_gravatar+'?s=48'" alt="avatar">
              <img v-else src="/img/default.png" alt="avatar">
            </picture>
          </v-avatar>
        </v-flex>
        <v-list-tile-content class="align-start grey--text text--darken-4">{{ dataTask.user_name }}</v-list-tile-content>
        <v-list-tile-content
          class="align-start grey--text text--darken-4"
        >Creat {{ dataTask.created_at_human }}</v-list-tile-content>
        <v-list-tile-content
          class="align-start grey--text text--darken-1"
        >Ultima actualització {{dataTask.updated_at_human}}</v-list-tile-content>
      </v-layout>
      <v-layout column align-end justify-space-between>
        <v-flex mb-2>
          <task-show :users="users" :task="dataTask" :uri="uri"></task-show>
        </v-flex>
        <v-flex mb-2>
          <task-update :users="users" :task="dataTask" @updated="updateTask" :uri="uri"></task-update>
        </v-flex>
        <v-flex mb-2>
          <task-destroy :task="dataTask" @removed="removeTask" :uri="uri"></task-destroy>
        </v-flex>
      </v-layout>
    </v-card-actions>
  </v-card>
</template>

<script>
import TaskCompletedToggle from "./TaskCompletedToggle";
import TaskDestroy from "./TaskDestroy";
import TaskUpdate from "./TaskUpdate";
import TaskShow from "./TaskShow";
import TasksTags from "./TasksTags";

export default {
  name: "TaskCard",
  components: {
    "task-completed-toggle": TaskCompletedToggle,
    "task-destroy": TaskDestroy,
    "task-update": TaskUpdate,
    "task-show": TaskShow,
    "tasks-tags": TasksTags
  },
  data() {
    return {
      dataTask: this.task
    };
  },
  props: {
    task: {
      type: Object,
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
    removeTask(task) {
      console.log(task);
      this.$emit("removed", task);
    },
    updateTask(task) {
      this.$emit("updated", task);
    }
  },
  watch: {
    task(newTask) {
      this.dataTask = newTask;
    }
  }
};
</script>

<style>
</style>
