<template>
  <v-form>
    <v-layout column>
      <v-text-field
        v-model="name"
        label="Nom"
        hint="El nom de l'etiqueta..."
        placeholder="Nom de l'etiqueta"
      ></v-text-field>
      <v-layout row align-center justify-space-around>
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

      <v-textarea v-model="description" label="Descripció" hint="Ka descripció de la tasca"></v-textarea>

      <v-flex class="text-xs-right">
        <v-btn
          class="grey--text text--lighten-2"
          flat
          @click="close"
          aria-label="Cancel·lar"
        >Cancel·lar</v-btn>
        <v-btn
          flat
          color="primary"
          @click="update"
          :disabled="working"
          :loading="working"
          aria-label="Actualitza"
        >Actualitza</v-btn>
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
    },
    close () {
      this.$emit("close")
    }
  },
  watch: {
    color: function(newColor, oldColor) {
      this.color = newColor;
    }
  }
};
</script>