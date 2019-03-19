<template>
  <v-btn
    v-can="'tags.destroys'"
    icon
    color="error"
    flat
    title="Eliminar l'etiqueta"
    :loading="removing"
    :disabled="removing"
    @click="destroy(tag)"
  >
    <v-icon>delete</v-icon>
  </v-btn>
</template>

<script>
export default {
  name: "TagDestroy",
  data() {
    return {
      removing: false
    };
  },
  props: {
    tag: {
      type: Object,
      required: true
    }
  },
  methods: {
    async destroy(tag) {
      let result = await this.$confirm(
        '<span class="grey--text text--lighten-1 body-1" >Elimina l\'etiqueta de la base de dades. Les etiquetes esborrades no es poden recuperar.<span>',
        {
          title: "Eliminar l\'etiqueta?",
          buttonTrueText: "Eliminar",
          buttonTrueColor: "red darken-3",
          buttonFalsetext: "Cancel·la",
          buttonFalseColor: "grey lighten-1",
          color: "grey lighten-2",
          icon: 'delete_forever',
          width: 350,
        }
      );
      if (result) {
        this.removing = true;
        window.axios
          .delete("/api/v1/tags/" + tag.id)
          .then(() => {
            this.$snackbar.showMessage("S'ha esborrat correctament l'etiqueta");
            this.$emit("removed", tag);
            this.removing = false;
          })
          .catch(error => {
            this.$snackbar.showError(error.message);
            this.removing = false;
          });
      }
    }
  }
};
</script>