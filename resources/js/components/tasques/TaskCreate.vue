<template>
  <span>
    <v-dialog
      v-model="dialog"
      :fullscreen="$vuetify.breakpoint.smAndDown"
      hide-overlay
      transition="dialog-bottom-transition"
    >
      <v-toolbar color="primary accent-1" class="white--text">
        <v-btn flat icon class="white--text" @click="dialog=false" aria-label="Tancar">
          <v-icon class="mr-1">close</v-icon>
        </v-btn>
        <v-toolbar-title class="white--text">Nova Tasca</v-toolbar-title>
        <v-spacer></v-spacer>
        <v-btn flat class="white--text" aria-label="Desar">
          Afegir
        </v-btn>
      </v-toolbar>
      <v-card>
        <v-card-text>
          <task-form :users="users" @close="dialog=false" @create="created" :uri="uri"></task-form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-btn
      @click="dialog = true"
      fab
      bottom
      right
      fixed
      color="primary"
      class="white--text"
      aria-label="Afegir"
    >
      <v-icon>add</v-icon>
    </v-btn>
  </span>
</template>

<script>
import TaskForm from "./TaskForm";
export default {
  name: "TaskCreate",
  components: {
    "task-form": TaskForm
  },
  data() {
    return {
      dialog: false
    };
  },
  props: {
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
    created(tags) {
      this.$emit("created", task);
      this.dialog = false;
    }
  }
};
</script>
