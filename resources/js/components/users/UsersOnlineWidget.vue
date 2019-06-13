<template>
  <v-menu offset-y>
    <v-badge slot="activator" left overlap color="success" class="ml-3 mr-2 mt-2">
      <span slot="badge" v-text="counter"></span>
      <v-btn icon color="white" :loading="loading" :disabled="loading">
        <v-icon color="primary">person</v-icon>
      </v-btn>
    </v-badge>
    <v-list v-if="counter > 0">
      <v-list-tile>
        <v-list-tile-title>
          <span v-if="counter === 1"><b v-text="users[0].name"></b> (Tú) online</span>
          <span v-else><b class="success--text" v-text="counter"></b> usuaris online</span>
        </v-list-tile-title>
      </v-list-tile>
      <v-divider></v-divider>
      <v-list-tile
        v-for="(user) in users"
        :key="user.id"
        :href="'/users?id=' + user.id "
        target="_blank"
      >
        <v-list-tile-avatar>
          <v-avatar :title="user.name" size="42" class="my-2">
            <v-img v-if="user.gravatar" :src="user.gravatar" alt="avatar"></v-img>
            <v-img v-else src="https://www.gravatar.com/avatar/" alt="avatar"></v-img>
          </v-avatar>
        </v-list-tile-avatar>
        <v-list-tile-content>
          <v-list-tile-title
            style="max-width: 450px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;"
          >
            <v-tooltip bottom>
              <span slot="activator">
                  <p>{{ user.name }}</p>
                </span>
              <span>{{ user.email }}</span>
            </v-tooltip>
            <p class="grey--text text--lighten-1 mb-2 font-weight-light">{{ user.email }}</p>
          </v-list-tile-title>
        </v-list-tile-content>
      </v-list-tile>
      <v-btn color="primary" flat raised href="/users">Lista usuaris</v-btn>
    </v-list>
    <v-divider v-if="counter === 1"></v-divider>
    <v-card class="py-2" v-if="counter === 1" flat>
      <v-layout align-center column class="text-xs-center">
        <v-avatar color="grey lighten-4" size="56" class="mb-2">
          <v-icon color="grey lighten-1" style="font-size: 48px;">error_outline</v-icon>
        </v-avatar>
        <h3 class="grey--text text--darken-2">No hi ha cap altre usuari online</h3>
        <p
          class="grey--text text--lighten-1 mb-2 font-weight-light" style="text-overflow: ellipsis;"
        >Comproba la teva conexió a internet</p>
        <v-btn color="primary" flat raised>Reitenta</v-btn>
      </v-layout>
    </v-card>
  </v-menu>
</template>

<script>
export default {
  name: "UsersOnlineWidget",
  data() {
    return {
      loading: false,
      users: []
    };
  },
  computed: {
    counter() {
      return this.users.length;
    },
    channel() {
      return window.Echo.join("App.Chat");
    }
  },
  created() {
    this.channel
      .here(users => {
        console.log("here");
        console.log(users);
        this.users = users;
      })
      .joining(user => {
        console.log("joining");
        console.log(user);
        this.users.push(user);
      })
      .leaving(user => {
        console.log("leaving");
        console.log(user);
        this.users.splice(this.users.indexOf(user), 1);
      });
  }
};
</script>