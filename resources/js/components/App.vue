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
        // { icon: 'folder', text: 'Projects', url: '/projects' },
        { icon: 'message', text: 'Contact', url: '/contact' },
        { icon: 'public', text: 'About', url: '/about' },
        { icon: 'settings', text: 'Settings', url: '/settings' },
      ]
    }
  },
  methods: {
    impersonate (user) {
      // console.log(user)
      if (user) {
        window.location.href = '/impersonate/take/' + user
      }
    }
  }
}
</script>
