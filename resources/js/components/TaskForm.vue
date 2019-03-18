<template>
  <v-form>
    <v-text-field
      v-model="name"
      label="Nom"
      hint="El nom de la tasca..."
      placeholder="Nom de la tasca"
    ></v-text-field>
    <v-switch v-model="completed" :label="completed ? 'Completada' : 'Pendent'"></v-switch>

    <v-textarea v-model="description" label="Descripció" hint="Escriu la descripció de la tasca..."></v-textarea>
    <user-select v-model="user" :users="dataUsers" label="Usuari" @selected="updateUser"></user-select>
    <div class="text-xs-right">
      <v-btn class="grey--text text--lighten-2" flat @click="$emit('close')" aria-label="Cancel·lar">
        Cancel·lar
      </v-btn>
      <v-btn flat color="primary" @click="add" aria-label="Afegir">
        Afegir
      </v-btn>
    </div>
  </v-form>
</template>

<script>
export default {
  name: "TaskForm",
  data() {
    return {
      user: null,
      name: "",
      completed: false,
      description: "",
      dataUsers: this.users,
      loading: false
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
    updateUser(user) {
      this.user = user;
    },
    reset() {
      this.task = {
        name: "",
        description: "",
        completed: "",
        user_id: null
      };
    },
    add() {
      this.loading = true;
      const task = {
        name: this.name,
        description: this.description,
        completed: this.completed,
        user_id: this.user.id
      };
      window.axios
        .post(this.uri, task)
        .then(response => {
          this.$snackbar.showMessage("Tasca creada correctament");
          this.$emit("created", response.data);
          this.loading = false;
          reset();
          this.$emit("close");
        })
        .catch(error => {
          this.$snackbar.showError(error.message);
          this.loading = false;
        });
    }
  },
  created() {
    this.user = window.laravel_user
  },
};
</script>
