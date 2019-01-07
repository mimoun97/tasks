<template>
    <v-form action="/login" method="POST">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Login</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-items class="hidden-xs-and-down">
                <v-btn href="/" icon>
                    <v-icon>arrow_back</v-icon>
                </v-btn>
            </v-toolbar-items>
        </v-toolbar>
        <v-card-text>
            <input type="hidden" name="_token" :value="csrfToken">
            <v-text-field
                    prepend-icon="person"
                    name="email"
                    label="Login"
                    type="text"
                    v-model="dataEmail"
                    :error-messages="emailErrors"
                    @input="$v.dataEmail.$touch()"
                    @blur="$v.dataEmail.$touch()"

            ></v-text-field>
            <v-text-field id="password"
                          prepend-icon="lock"
                          name="password"
                          label="Password"
                          type="password"
                          v-model="password"
                          :error-messages="passwordErrors"
                          @input="$v.password.$touch()"
                          @blur="$v.password.$touch()"
            ></v-text-field>
        </v-card-text>
        <v-card-actions>
          <v-card-text class="ml-4"><a href="/home" class="grey--text">No recorda la contrasenya?</a></v-card-text>
          <v-spacer></v-spacer>
          <v-btn color="primary" type="submit" :disabled="$v.$invalid">Login</v-btn>
        </v-card-actions>
        <v-card-text class="grey lighten-1">
      <v-container text-xs-center>
        <v-layout>
      <v-flex href="/login" xs12 text-xs-center>
        <span class="white--text">No tens un compte?</span>
        <a href="/register" class="indigo--text ml-2"><b> Registra't</b></a>
      </v-flex>
        </v-layout>
       </v-container>
    </v-card-text>
    </v-form>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength } from 'vuelidate/lib/validators'

export default {
  name: 'LoginForm',
  mixins: [validationMixin],
  validations: {
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) }
  },
  data () {
    return {
      dataEmail: this.email,
      password: ''
    }
  },
  props: [ 'email', 'csrfToken' ],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.email && errors.push('El camp email ha de ser un email vàlid.')
      !this.$v.dataEmail.required && errors.push('El camp email és obligatori.')
      return errors
    },
    passwordErrors () {

    }
  }
}
</script>
