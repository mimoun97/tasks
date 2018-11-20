<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: null,
        drawerRigth: false,
      items: [
        { icon: 'home', text: 'Welcome', url: '/' },
        { icon: 'home', text: 'Home', url: '/home' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: true,
          children: [
            { icon: 'list', text: 'Tasques amb PHP', url: '/tasks' },
            { icon: 'list_alt', text: 'Tasques tailwind', url: '/tasks_vue' },
            { icon: 'assignment', text: 'Tasques', url: '/tasques' }
          ]
        },
        { icon: 'message', text: 'Contact', url: '/contact' },
        { icon: 'public', text: 'About', url: '/about' }
      ]
    }
  }
}
</script>
