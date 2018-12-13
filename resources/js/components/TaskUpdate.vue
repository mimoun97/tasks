<template>
    <div>
        <h2>Task-update</h2>
        <task-update-form></task-update-form>
    </div>
</template>

<script>

import TaskUpdateForm from './TaskUpdateForm.vue'

export default {
  name: 'TaskUpdate',
  components: {
    'task-update-form': TaskUpdateForm
  },
  data () {
    return {}
  },
  props: {
  } }
</script>

<style scoped>

</style>
