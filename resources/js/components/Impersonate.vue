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
      dataUsers: [],
      errorMessage: '',
    }
  },
  props: {
    users: {
      type: Array,
      required: false
    },
    url: {
      type: String,
      default: '/api/v1/users'
    },
    label: {
      type: String,
      default: 'Usuaris'
    }
  }, 
  created() {
    if (this.users){
      this.dataUsers = this.users
    } else {
      window.axios.get(this.url).then((response) => {
        this.dataUsers = response.data
      }).catch((error) => {
        this.errorMessage = error.response.data
      })
    }
  }
}
</script>

<style scoped>

</style>
