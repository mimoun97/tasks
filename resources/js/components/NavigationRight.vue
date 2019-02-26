<template>
  <v-navigation-drawer v-model="dataDrawer" fixed right clipped-right clipped app class="elevation-2">
    <v-card xs12 md12>
      <v-card-title class="primary lighten-2 white--text">
        <h4 class="subheading">Perfil</h4>
      </v-card-title>
      <v-layout justify-center column fill-height>
        <v-flex xs12 class="text-xs-center">
          <v-card>
            <v-layout justify-center row>
              <v-avatar size="96" color="grey lighten-4" class="mt-2 elevation-2">
                <img :src="user.gravatar+'?s=96'">
              </v-avatar>
            </v-layout>
            <v-layout justify-center align-center row>
              <v-card-title primary-title class="text-xs-center">
                <v-layout align-center justify-start column>
                  <v-flex xs12>
                    <h3 class="headline font-weight-light">{{ user.name }}</h3>
                  </v-flex>

                  <v-flex xs12>
                    <div class="font-weight-medium grey--text text--lighten-1">{{ user.email }}</div>
                  </v-flex>

                  <v-flex xs12>
                    <v-chip outline label color="green" v-if="user.admin">Admin</v-chip>
                    <v-chip outline label color="grey" v-else>Regular</v-chip>
                  </v-flex>
                </v-layout>

                <v-layout align-center justify-start column>
                  <v-list>
                    <v-list-group v-ripple prepend-icon="account_circle" no-action>
                      <v-list-tile slot="activator">
                        <v-list-tile-content>Rols</v-list-tile-content>
                      </v-list-tile>

                      <v-list-tile v-for="rol in user.roles" :key="rol" no-data-text="No te cap rol.">
                        <v-list-tile-content>
                          <v-list-tile-title>{{ rol }}</v-list-tile-title>
                        </v-list-tile-content>
                      </v-list-tile>
                    </v-list-group>
                    <v-list-group v-ripple prepend-icon="lock" no-action>
                      <v-list-tile slot="activator">
                        <v-list-tile-content>Permissos</v-list-tile-content>
                      </v-list-tile>

                      <v-list-tile v-for="permis in user.permissions" :key="permis" no-data-text="No te cap permís.">
                        <v-list-tile-content>
                          <v-list-tile-title>{{ permis }}</v-list-tile-title>
                        </v-list-tile-content>
                      </v-list-tile>
                    </v-list-group>
                  </v-list>
                </v-layout>
              </v-card-title>
            </v-layout>

            <v-card-actions class="text-xs-center">
              <v-layout align-center justify-end>
                <v-form action="logout" method="POST">
                  <input type="hidden" name="_token" :value="csrfToken">
                  <v-btn
                    depressed
                    flat
                    small
                    round
                    color="red lighten-2 elevation-0"
                    type="submit"
                    placeholder="Sortir"
                  >
                    <span>Sortir</span>
                    <v-icon right>exit_to_app</v-icon>
                  </v-btn>
                </v-form>
                <v-btn block flat href="/profile" color="secondary lighten-2" dark>
                  <span>Perfil</span>
                  <v-icon right>edit</v-icon>
                </v-btn>
              </v-layout>
            </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-card>
    <v-card>
      <v-card-title dark class="primary lighten-2 white--text" primary-title>
        <h4 class="subheading">Opcions administrador</h4>
      </v-card-title>

      <v-layout row wrap>
        <v-flex xs12 v-if="canImpersonate">
          <impersonate label="Entrar com..." url="/api/v1/regular_users"></impersonate>
        </v-flex>

        <v-layout
          v-if="isImpersonating"
          column
          class="block text-xs-center align-center justify-center my-2"
        >
          <v-flex xs12 align-center>
            <v-avatar :title="impersonatedBy.name+' '+'( '+impersonatedBy.email+' )'">
              <img :src="gravatar" alt="avatar">
            </v-avatar>
            <v-icon x-large color="primary">swap_horiz</v-icon>
            <v-avatar :title="user.name+' '+'( '+user.email+' )'">
              <img :src="user.gravatar" alt="avatar">
            </v-avatar>
          </v-flex>
          <p class="my-2">
            <b class>{{ impersonatedBy.name }}</b> està suplantant a
            <b>{{ user.name }}</b>
          </p>
          <v-btn flat href="/impersonate/leave" class="primary--text my-4">Abandonar la suplantació</v-btn>
        </v-layout>
      </v-layout>
    </v-card>
  </v-navigation-drawer>
</template>

<script>
export default {
  name: "NavigationRight",
  data() {
    return {
      dataDrawer: this.drawerRight
      //   isImpersonating: window.isImpersonating,
      //   canImpersonate: window.canImpersonate
    };
  },
  props: {
    drawerRight: {
      Type: Boolean,
      default: null
    },
    csrfToken: {
      Type: String
    }
  },
  watch: {
    dataDrawer(newval) {
      this.$emit("input", newval);
    },
    drawerRight(newval) {
      this.dataDrawer = newval;
    }
  },
  model: {
    prop: "drawerRight",
    event: "input"
  },
  computed: {
    isImpersonating: function() {
      return window.impersonatedBy ? true : false;
    },
    canImpersonate: function() {
      return window.laravel_user.admin || false;
    },
    gravatar: function() {
      return (
        "https://www.gravatar.com/avatar/" +
        window.md5(
          window.impersonatedBy
            ? window.impersonatedBy.email
            : "google@gmail.com"
        )
      );
    },
    user: function() {
      return window.laravel_user;
    },
    impersonatedBy: function() {
      return window.impersonatedBy || undefined;
    }
  }
};
</script>