<template>
  <span>
    <v-dialog
      v-model="dialog"
      :fullscreen="$vuetify.breakpoint.smAndDown"
      hide-overlay
      transition="dialog-bottom-transition"
      @keydown.esc="dialog=false"
    >
      <v-toolbar color="primary accent-1" class="white--text">
        <v-btn flat icon class="white--text" @click="dialog=false" aria-label="Tancar">
          <v-icon class="mr-1">close</v-icon>
        </v-btn>
        <v-toolbar-title class="white--text">Editar Tasca</v-toolbar-title>
        <v-spacer></v-spacer>
        <!--TODO-->
        <v-btn flat class="white--text" aria-label="Desar">
          Guardar
        </v-btn>
      </v-toolbar>
      <v-card>
        <v-card-text>
          <task-update-form
            :task="task"
            :uri="uri"
            :users="users"
            @close="dialog=false"
            @updated="updated"
          ></task-update-form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-btn
      v-if="$can('tasks.update',task)"
      icon
      color="grey"
      flat
      title="Canviar la tasca"
      @click="dialog=true"
      aria-label="Editar"
    >
      <v-icon>edit</v-icon>
    </v-btn>
  </span>
</template>

<script>
import TaskUpdateForm from "./TaskUpdateForm";
export default {
  name: "TaskUpdate",
  components: {
    "task-update-form": TaskUpdateForm
  },
  data() {
    return {
      dialog: false
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
    updated(task) {
      this.$emit("updated", task);
    }
  }
};
</script>
