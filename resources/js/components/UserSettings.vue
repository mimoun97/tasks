<template>
  <v-container fill-height fluid grid-list-xl>
    <v-layout justify-center wrap>
      <v-flex xs12 md10>
        <v-card>
          <v-toolbar color="primary">
            <v-toolbar-title class="white--text">Settings</v-toolbar-title>
            <v-spacer></v-spacer>
          </v-toolbar>
          <v-card-title class="headline" primary-title>Color</v-card-title>
          <v-card-text class="grey--text">
            <span>
              Escolliu el color del tema
              <b class="primary--text">principal</b>
            </span>
            <p class="grey--text text--lighten-1">
              Un
              <b>color primari</b> és el color que es mostra amb més freqüència en les pantalles i components de l'aplicació.
            </p>
          </v-card-text>
          <v-layout align-center justify-center row wrap>
            <v-flex
              xs8
              :class="{'ml-2': $vuetify.breakpoint.smAndDown, 'ml-5': $vuetify.breakpoint.mdAndUp}"
            >
              <settings-color @updateColor="updatePrimaryColor"/>
            </v-flex>

            <v-flex xs4 mr-2>
              <v-avatar size="48" color="primary" class="mt-2 elevation-2"></v-avatar>
            </v-flex>
          </v-layout>

          <v-card-text class="grey--text">
            <span>
              Escolliu el color del tema
              <b class="secondary--text">secundari</b>
            </span>
            <p class="grey--text text--lighten-1">
              Un
              <b>color secundari</b> proporciona més formes d'accentuar i distingir el seu producte.
            </p>
          </v-card-text>
          <v-layout align-center justify-center row wrap>
            <v-flex
              xs8
              :class="{'ml-2': $vuetify.breakpoint.smAndDown, 'ml-5': $vuetify.breakpoint.mdAndUp}"
            >
              <settings-color @updateColor="updateSecondaryColor"/>
            </v-flex>

            <v-flex xs4 mr-2>
              <v-avatar size="48" color="secondary" class="mt-2 elevation-2"></v-avatar>
            </v-flex>
          </v-layout>

          <v-card-title class="headline" primary-title>User</v-card-title>
          <v-card-text>
            <p
              class="subheading"
            >Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eos, corrupti.</p>
            <span class="grey--text text--lighten-1">
              Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut amet reiciendis nihil accusantium
              quisquam. Nobis, sint voluptatem tenetur aut voluptate
              deserunt. Praesentium expedita maxime asperiores ab odio delectus aliquam blanditiis.
            </span>
            <v-form>
              <v-container>
                <v-layout row wrap>
                  <v-flex xs12 xs6 md11>
                    <v-text-field v-model="userEmail" label="User Email" hint="Set user email"/>
                  </v-flex>

                  <v-flex xs12 sm6 md1/>

                  <v-flex xs12 xs6 md11>
                    <v-switch label="Email Notification" color="success" v-model="notification"/>
                  </v-flex>
                  <v-flex>
                    <span class="grey--text text--lighten-1">
                      Lorem ipsum dolor, sit amet consectetur adipisicing elit. Aut amet reiciendis nihil accusantium
                      quisquam. Nobis, sint voluptatem tenetur aut voluptate
                      deserunt. Praesentium expedita maxime asperiores ab odio delectus aliquam blanditiis.
                    </span>
                  </v-flex>
                  <v-flex xs12 xs6 md1/>
                </v-layout>
              </v-container>
            </v-form>
          </v-card-text>

          <v-divider></v-divider>

          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="primary" flat>Save Changes</v-btn>
          </v-card-actions>
        </v-card>
      </v-flex>

      <v-flex xs12 md8>
        <impersonate
          v-if="$hasRole('TaskManager')"
          label="Entrar com..."
          url="/api/v1/regular_users"
        ></impersonate>
      </v-flex>

      <v-flex xs12 md8>
        <upload-button v-if="!filename" title="Busca fitxer" :selectedCallback="fileSelectedFunc"/>
        <v-card v-else color="blue lighten-2" dark>
          <v-card-title>
            Arxiu seleccionat:
            <b class="title">{{ filename }}</b>
          </v-card-title>
          <v-card-text>
            <v-btn color="red" flat @click="filename=null">Cancel·la</v-btn>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>
<script>
import UploadButton from "./ui/UploadButton";
import SettingsColor from "./SettingsColor";
export default {
  name: "UserSettings",
  data() {
    return {
      color: false,
      filename: null,
      userEmail: window.laravel_user.email,
      notification: false
    };
  },
  components: {
    "settings-color": SettingsColor,
    "upload-button": UploadButton
  },
  methods: {
    fileSelectedFunc(file) {
      this.filename = file.name;
    },
    updatePrimaryColor(color) {
      console.log("PRIMARY_COLOR" + color);
      window.localStorage.setItem("PRIMARY_COLOR_KEY", color);
      this.$vuetify.theme.primary = color;
    },
    updateSecondaryColor(color) {
      console.log("SECONDARY_COLOR" + color);
      window.localStorage.setItem("SECONDARY_COLOR_KEY", color);
      this.$vuetify.theme.secondary = color;
    }
  }
};
</script>