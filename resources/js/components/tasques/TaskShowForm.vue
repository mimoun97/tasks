<template>
  <v-form>
    <v-text-field
      autofocus
      v-model="name"
      label="Nom"
      hint="El nom de la tasca..."
      placeholder="Nom de la tasca"
      :readonly="true"
    ></v-text-field>

    <v-switch :readonly="true" v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

    <v-textarea
      v-model="description"
      label="Descripció"
      hint="Escriu la descripció de la tasca..."
      :readonly="true"
    ></v-textarea>

    <user-select :read-only="true" :users="dataUsers" label="Usuari" v-model="user"></user-select>
  </v-form>
</template>

<script>
export default {
  name: "TaskShowForm",
  data() {
    return {
      name: this.task.name,
      description: this.task.description,
      completed: this.task.completed,
      user: null,
      dataUsers: this.users,
      working: false
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
  watch: {
    task(task) {
      this.updateUser(task);
    }
  },
  methods: {
    updateUser(task) {
      this.user = this.users.find(user => {
        return parseInt(user.id) === parseInt(task.user_id);
      });
    },
    update() {
      this.working = true;
      const newTask = {
        name: this.name,
        description: this.description,
        completed: this.completed,
        user: this.user
      };
      window.axios
        .put(this.uri + "/" + this.task.id, newTask)
        .then(response => {
          this.$emit("updated", response.data);
          this.$emit("close");
          this.working = false;
        })
        .catch(error => {
          this.$snackbar.showError(error);
          this.working = false;
        });
    }
  },
  created() {
    this.updateUser(this.task);
  }
};
</script>
