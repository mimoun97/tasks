<template>
  <v-form>
    <v-layout column>
      <v-text-field
        v-model="name"
        label="Nom"
        hint="El nom de l'etiqueta..."
        placeholder="Nom de l'etiqueta"
      ></v-text-field>
      <v-layout row align-center justify-space-around >
        <v-flex xs10 md8 mr-2>
          <v-text-field
            v-model="color"
            label="Color"
            hint="El color de l'etiqueta... #1992D4, yellow o rgb(97, 41, 160)"
            placeholder="Color de l'etiqueta"
          ></v-text-field>
        </v-flex>
        <v-flex xs4 md6>
          <v-avatar :color="color" size="48px"></v-avatar>
        </v-flex>
      </v-layout>

      <v-textarea v-model="description" label="Descripció" hint="bla bla bla..."></v-textarea>

      <v-flex class="text-xs-center">
        <v-btn @click="$emit('close')">
          <v-icon class="mr-1">exit_to_app</v-icon>Cancel·lar
        </v-btn>
        <v-btn color="success" @click="update" :disabled="working" :loading="working">
          <v-icon class="mr-1">save</v-icon>Actualitzar
        </v-btn>
      </v-flex>
    </v-layout>
  </v-form>
</template>

<script>
export default {
  name: "TaskUpdateForm",
  data() {
    return {
      name: this.tag.name,
      color: this.tag.color,
      description: this.tag.description,
      working: false
    };
  },
  props: {
    tag: {
      type: Object,
      required: true
    }
  },
  methods: {
    update() {
      this.working = true;
      const newTag = {
        name: this.name,
        color: this.color,
        description: this.description
      };
      window.axios
        .put("/api/v1/tags/" + this.tag.id, newTag)
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
  watch: {
    color: function(newColor, oldColor) {
      this.color = newColor;
    }
  }
};
</script>