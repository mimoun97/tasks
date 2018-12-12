<template>
    <user-select :users="dataUsers"></user-select>

</template>

<script>
import UserSelect from './UserSelect'
export default {
  name: 'Impersonate',
  components: {
    'user-select': UserSelect
  },

  data () {
    return {
    }
  },
  props: {
    users: {
      type: Array,
      required: true
    },
    url: {
      type: String,
      default: '/api/v1/users'
    },
    label: {
      type: String,
      default: 'Usuaris'
    }
  }
}
</script>

<style scoped>

</style>
