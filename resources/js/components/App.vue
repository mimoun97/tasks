<script>
export default {
  el: '#app',
  name: 'App',
  data () {
    return {
      drawer: false,
      drawerRigth: false,
      items: [
        { icon: 'home', text: 'Welcome', url: '/' },
        { icon: 'dashboard', text: 'Home', url: '/home' },
        {
          icon: 'keyboard_arrow_up',
          'icon-alt': 'keyboard_arrow_down',
          text: 'Tasques',
          model: true,
          children: [
            { icon: 'list', text: 'Tasques amb PHP i Tailwind', url: '/tasks' },
            { icon: 'list_alt', text: 'Tasques Vue', url: '/tasks_vue' },
            { icon: 'assignment', text: 'Tasques', url: '/tasques' }
          ]
        },
        { icon: 'tags', text: 'Tags', url: '/tags' },
        { icon: 'notifications', text: 'Notifications', url: '/notifications' },
        { icon: 'receipt', text: 'Changelog', url: '/changelog' },
        { icon: 'message', text: 'Contact', url: '/contact' },
        { icon: 'public', text: 'About', url: '/about' },
        { icon: 'settings', text: 'Settings', url: '/settings' },
      ]
    }
  }
}
</script>
