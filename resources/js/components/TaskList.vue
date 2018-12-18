<template>
    <div>
        <h3>ask-list</h3>
        <tasks-tags tasks="tasks"></tasks-tags>
    </div>
</template>

<script>
import TasksTags from './TasksTags'
export default {
  name: 'TaskList',
  components: { TasksTags },
  data () {
    return {
      name: 'task-list'
    }
  }
}
</script>

<style scoped>

</style>
