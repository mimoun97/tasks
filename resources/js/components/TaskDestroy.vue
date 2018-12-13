<template>
    <h2>DESTROY</h2>
</template>

<script>
export default {
  name: 'TaskDestroy',
  data () {
    return {
      name: 'Destroy'
    }
  },
  props: {
    uri: {
      type: String,
      required: true
    }
  }
}
</script>

<style scoped>

</style>
