<template>
  <div>
    <v-toolbar color="primary lighten-1">
      <v-menu>
        <v-btn slot="activator" icon dark aria-label="Menu">
          <v-icon>more_vert</v-icon>
        </v-btn>
        <v-list v-for="i in 5" :key="i">
          <v-list-tile>
            <v-list-tile-title>Opció {{ i }}</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-toolbar-title class="white--text">Usuaris</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon class="white--text" aria-label="Settings">
        <v-icon>settings</v-icon>
      </v-btn>
      <v-btn
        icon
        class="white--text"
        @click="refresh"
        :loading="loading"
        :disabled="loading"
        aria-label="Refresh"
      >
        <v-icon>refresh</v-icon>
      </v-btn>
    </v-toolbar>

    <v-card>
      <v-card-title class="mx-2">
        <v-layout row wrap>
          <v-flex xs12>
            <v-text-field
              prepend-inner-icon="search"
              label="Buscar"
              v-model.lazy="search"
              browser-autocomplete
              clearable
            ></v-text-field>
          </v-flex>
        </v-layout>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="dataUsers"
        :search="search"
        no-results-text="No s'ha trobat cap registre coincident"
        no-data-text="No hi han dades disponibles"
        rows-per-page-text="Usuaris per pàgina"
        :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
        :loading="loading"
        :pagination.sync="pagination"
      >
        <!-- class="hidden-md-and-down"
        v-if="$vuetify.breakpoint.mdAndUp">-->
        <v-progress-linear slot="progress" color="primary" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="{item: user}">
          <tr>
            <td>{{ user.id }}</td>
            <td v-text="user.name"></td>
            <td v-text="user.mobile_verified_at"></td>
            <td>
              <v-avatar :title="user.name" size="48">
                <img v-if="user.gravatar" :src="user.gravatar+'?48'" alt="avatar">
                <img v-else src="/img/default.png" alt="avatar">
              </v-avatar>
            </td>
            <td>{{user.mobile}}</td>
            <td>
              <mobile-sms :user="user"></mobile-sms>
              <verify-mobile-form :user="user"></verify-mobile-form>
              <user-emails :user="user"></user-emails>
            </td>
          </tr>
        </template>
      </v-data-table>
      <!-- <v-data-iterator
        class="hidden-lg-and-up"
        v-if="$vuetify.breakpoint.mdAndDown"
        :items="dataTasks"
        :search="search"
        no-results-text="No s'ha trobat cap registre coincident"
        no-data-text="No hi han dades disponibles"
        rows-per-page-text="Tasques per pàgina"
        :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
        :loading="loading"
        :pagination.sync="pagination"
      >
        
      </v-data-iterator>-->
    </v-card>
  </div>
</template>

<script>
import MobileSMS from './MobileSMS'
import UserEmails from './UserEmails'

export default {
  name: "Users",
  components: {
    'mobile-sms': MobileSMS,
    'user-emails': UserEmails
  },
  data() {
    return {
      user: "",
      loading: false,
      dataUsers: this.users,
      search: "",
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: "Id", value: "id" },
        { text: "Name", value: "name" },
        { text: "Mòbil verificat", value: "mobile_verified_at" },
        { text: "Avatar", value: "gravatar" },
        { text: "mobile", value: "mobile" },
        { text: "Accions", value: "accions" }
      ]
    };
  },
  props: {
    users: {
      type: Array,
      required: true
    }
  },
  methods: {
    refresh() {
      this.loading = true;
      window.axios
        .get(this.uri)
        .then(response => {
          this.dataUsers = response.data;
          this.loading = false;
          this.$snackbar.showMessage("Usuaris actualitzats correctament");
        })
        .catch(error => {
          this.loading = false;
        });
    },
    sendMail(user) {
        // TODO sendMail
        console.log("sendMail to:", user.email);
    }
  },
  created() {},
  mounted() {
    console.debug(this.users);
  }
};
</script>

<style>
</style>
