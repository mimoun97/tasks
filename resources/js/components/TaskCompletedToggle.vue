<template>
  <v-switch
    v-model="dataTask.completed"
    :label="dataTask.completed ? 'Completada' : 'Pendent'"
    :loading="loading"
  ></v-switch>
</template>

<script>
export default {
  name: "TaskCompletedToggle",
  data() {
    return {
      dataTask: this.task,
      loading: false
    };
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  watch: {
    task(task) {
      this.dataTask = task;
    },
    dataTask: {
      handler: function(dataTask, oldTask) {
        if (dataTask.completed === oldTask.completed) {
          dataTask.completed ? this.uncompleteTask() : this.completeTask();
        }
      },
      deep: true
    }
  },
  methods: {
    completeTask: _.throttle(function() {
      console.log("completeTask ()");
      this.loading = true;
      window.axios
        .post("api/v1/completed_task/" + this.task.id)
        .then(response => {
          this.$snackbar.showMessage(
            "Tasca completada correctament: " + response
          );
          //this.dataTask.completed = true;
          this.loading = false;
        })
        .catch(error => {
          this.$snackbar.showError(error);
          this.loading = false;
        });
    }, 1000),
    uncompleteTask() {
      this.loading = true;
      console.log("okkkk")
      window.axios
        .delete("api/v1/completed_task/" + this.task.id)
          .then(response => {
            this.$snackbar.showMessage(
              "Tasca descompletada correctament: " + response.toString()
            );
            this.dataTask.completed = false;
            debugger
            this.loading = false;
          })
          .catch(error => {
            console.log(error)
            this.$snackbar.showError(error);
            this.loading = false;
          });
    }
  }
};
</script>
