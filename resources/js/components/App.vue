<script>
export default {
  el: "#app",
  name: "App",
  data() {
    return {
      drawer: false,
      drawerRigth: false,
      show1: false, //for password reset
      show2: false //for password reset
    };
  },
  created() {
    if (window.localStorage.getItem("PRIMARY_COLOR_KEY"))
      this.$vuetify.theme.primary = window.localStorage.getItem(
        "PRIMARY_COLOR_KEY"
      );
    if (window.localStorage.getItem("SECONDARY_COLOR_KEY"))
      this.$vuetify.theme.secondary = window.localStorage.getItem(
        "SECONDARY_COLOR_KEY"
      );

    if (
      window.location.href
        .split("/")
        .pop()
        .indexOf("homescreen") > -1
    ) {
      window.onload = function() {
        window.Vue.prototype.$snackbar.showInfo(
          "Gràcies per instal·lar la nostra app!"
        );
      };
    }

    window.Echo.channel('tasks')
    .listen('TaskCompleted', (e) => {
        console.log(e.task.name);
    });
  }
};
</script>
<style scoped>
.pointer {
  cursor: pointer;
}
</style>

