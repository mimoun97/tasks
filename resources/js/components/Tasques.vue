<template>
  <span>
    <task-create :users="dataUsers" :created="refresh()"></task-create>
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
    showUpdate() {
      this.editDialog = true;
    },
    opcio1() {
      console.log("OPCIO 1 REFRESH");
    },
    removeTask(task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1);
    },
    // destroyWithPromises () {
    //   this.$confirm().then(
    //     // Ok tirem endavant
    //     window.axios.then(
    //       window.axios.then(
    //     ).catch
    //   ).catch(
    //     // No fer res
    //   )
    // },
    async destroy(task) {
      // ES6 async await
      let result = await this.$confirm(
        "Les tasques esborrades no es poden recuperar",
        {
          title: "Esteu segurs?",
          buttonTruetext: "Eliminar",
          buttonFalsetext: "Cancel·lar",
          // icon: '',
          color: "error"
        }
      );
      if (result) {
        this.removing = task.id;
        window.axios
          .delete(this.uri + "/" + task.id)
          .then(() => {
            // this.refresh() // Problema -> rendiment
            this.removeTask(task);
            this.deleteDialog = false;
            task = null;
            this.$snackbar.showMessage("S'ha esborrat correctament la tasca");
            this.removing = null;
          })
          .catch(error => {
            this.$snackbar.showError(error.message);
            this.removing = null;
          });
      }
    },
    create(task) {
      console.log("TODO CREATE TASK");
    },
    update(task) {
      console.log("TODO UPDATE TASK " + task.id);
    },
    show(task) {
      console.log("TODO SHOW TASK " + task.id);
    },
    refresh() {
      // this.loading = true
      window.axios
        .get(this.uri)
        .then(response => {
          this.dataTasks = response.data;
          this.loading = false;
          this.refresh();
          this.$snackbar.showMessage("Tasques actualitzades correctament");
        })
        .catch(error => {
          console.log(error);
          this.loading = false;
        });
    }
  }
};
</script>
