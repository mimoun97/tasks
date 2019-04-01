<template>
  <v-navigation-drawer v-model="dataDrawer" fixed dark clipped app class="primary lighten-1">
    <v-list dense>
      <template v-for="item in items">
        <v-layout v-if="item.heading" :key="item.heading" row align-center>
          <v-flex xs6>
            <v-subheader v-if="item.heading">{{ item.heading }}</v-subheader>
          </v-flex>
          <v-flex xs6 class="text-xs-center">
            <a href="#!" class="body-2 black--text">EDIT</a>
          </v-flex>
        </v-layout>
        <v-list-group
          v-else-if="item.children"
          v-model="item.model"
          :key="item.text"
          :prepend-icon="item.model ? item.icon : item['icon-alt']"
        >
          <v-list-tile slot="activator" :href="item.url">
            <v-list-tile-content>
              <v-list-tile-title>{{ item.text }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
          <v-list-tile
            v-for="(child, i) in item.children"
            :key="i"
            :href="child.url"
            :class="isActive(child) ? activeClass : ''"
          >
            <v-list-tile-action v-if="child.icon">
              <v-icon :color="isActive(child)  ? activeIconColor : 'white'">{{ child.icon }}</v-icon>
            </v-list-tile-action>
            <v-list-tile-content>
              <v-list-tile-title>{{ child.text }}</v-list-tile-title>
            </v-list-tile-content>
          </v-list-tile>
        </v-list-group>
        <v-list-tile
          v-else
          :key="item.text"
          :href="item.url"
          class="menu-border-left"
          :class="isActive(item) ? activeClass : ''"
        >
          <v-list-tile-action>
            <v-icon :color="isActive(item)  ? activeIconColor : 'white'">{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title>{{ item.text }}</v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </template>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
//:active-class="isActive(child)"
export default {
  name: "Navigation",
  data() {
    return {
      activeClass: ["primary--text", "text--lighten-2", "primary", "darken-1"],
      activeIconColor: "primary lighten-2",
      dataDrawer: this.drawer,
      items: [
        { icon: "home", text: "Welcome", url: "/" },
        { icon: "dashboard", text: "Home", url: "/home" },
        {
          icon: "keyboard_arrow_up",
          "icon-alt": "keyboard_arrow_down",
          text: "Tasques",
          model: true,
          children: [
            { icon: "list", text: "Tasques amb PHP i Tailwind", url: "/tasks" },
            { icon: "list_alt", text: "Tasques Vue", url: "/tasks_vue" },
            { icon: "assignment", text: "Tasques", url: "/tasques" }
          ]
        },
        { icon: "tags", text: "Tags", url: "/tags" },
        { icon: "notifications", text: "Notifications", url: "/notifications" },
        { icon: "receipt", text: "Changelog", url: "/changelog" },
        { icon: "message", text: "Contact", url: "/contact" },
        { icon: "public", text: "About", url: "/about" },
        { icon: "settings", text: "Settings", url: "/settings" },
        { icon: "phone", text: "Device Features", url: "/device-features" },
        { icon: "access_time", text: "Clock", url: "/clock" },
        { icon: "email", text: "Newsletters", url: "/newsletters" },
        { icon: "chat", text: "Chat", url: "/chat" },
        { icon: "videogame_asset", text: "GamePad", url: "/gamepad" }
      ]
    };
  },
  props: {
    drawer: {
      Type: Boolean,
      default: false
    }
  },
  watch: {
    dataDrawer(drawer) {
      this.$emit("input", drawer);
    },
    drawer(drawer) {
      this.dataDrawer = drawer;
    }
  },
  model: {
    prop: "drawer",
    event: "input"
  },
  methods: {
    isActive(item) {
      let path = window.location.pathname;
      return item.url === path
    }
  }
};
</script>
