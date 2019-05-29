<template>
  <v-btn
    v-can="'tasks.destroy'"
    icon
    color="grey"
    flat
    title="Eliminar la tasca"
    :loading="removing"
    :disabled="removing"
    @click.stop="destroy(task)"
  >
    <v-icon>delete</v-icon>
  </v-btn>
</template>

<script>
import EventBus from "../eventBus";
export default {
  name: "TaskDestroy",
  data() {
    return {
      removing: false
    };
  },
  props: {
    task: {
      type: Object,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  methods: {
    async destroy(task) {
      // ES6 async await
      let result = await this.$confirm(
        '<span class="grey--text text--lighten-1 body-1" >Elimina la tasca de la base de dades. Les tasques esborrades no es poden recuperar.<span>',
        {
          title: "Eliminar la tasca?",
          buttonTrueText: "Eliminar",
          buttonTrueColor: "red darken-3",
          buttonFalsetext: "Cancel·la",
          buttonFalseColor: "grey lighten-1",
          color: "grey lighten-2",
          icon: "delete_forever",
          width: 350
        }
      );
      if (result) {
        this.removing = true;
        window.axios
          .delete(this.uri + "/" + task.id)
          .then(() => {
            this.$snackbar.showMessage("S'ha esborrat correctament la tasca");
            this.$emit("removed", task);
            this.removing = false;
          })
          .catch(error => {
            this.$snackbar.showError(error.message);
            this.removing = false;
          })
          .finally(() => {
            this.removing = false;
          })
        }
      }
  },
  mounted () {
    EventBus.$on("remove-task-gesture-"+ this.task.id, task => {
      // console.log("remove-task-gesture-"+ task.id);
      this.destroy(task)
    });
  }
};
</script>
