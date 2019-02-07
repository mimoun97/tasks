<template>
    <v-switch v-model="dataTask.completed" :label="dataTask.comple ? 'Completada' : 'Pendent'"></v-switch>
</template>

<script>
export default {
  name: 'TaskCompletedToggle',
  data () {
    return {
      dataTask: this.task
    }
  },
  props: {
    task: {
      type: Object,
      required: true
    }
  },
  watch: {
    task (task) {
      this.dataTask = task
    },
    dataTask: {
      handler: function (dataTask) {
        if (dataTask.completed) this.completeTask()
        else this.uncompleteTask()
      },
      deep: true
    }
  },
  methods: {
    completeTask () {
      window.axios.post('api/v1/completed_task/' + this.task.id)
    },
    uncompleteTask () {
      window.axios.delete('api/v1/completed_task/' + this.task.id)
    }
  }
}
</script>
