<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: false,
      drawerRigth: false,
    }
  },
  created () {
    if (window.localStorage.getItem('PRIMARY_COLOR_KEY')) this.$vuetify.theme.primary = window.localStorage.getItem('PRIMARY_COLOR_KEY')
    console.log('Color_primary: '+ this.$vuetify.theme.primary)
  }
}
</script>
