<template>
<div>
    <v-form action="/register" method="POST">
        <v-toolbar dark color="primary">
            <v-toolbar-title>Register</v-toolbar-title>
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
                    name="name"
                    label="Name"
                    type="text"
                    v-model="dataName"
                    :error-messages="nameErrors"
                    @input="$v.dataName.$touch()"
                    @blur="$v.dataName.$touch()"
            ></v-text-field>
            <v-text-field
                    prepend-icon="email"
                    name="email"
                    label="email"
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
            <v-text-field id="password"
                          prepend-icon="lock"
                          name="password_confirmation"
                          label="Password Confirmation"
                          type="password"
                          v-model="repeatPassword"
                          :error-messages="passwordConfirmationErrors"
                          @input="$v.repeatPassword.$touch()"
                          @blur="$v.repeatPassword.$touch()"
            ></v-text-field>
        </v-card-text>
        <v-card-actions>
            <v-card-text class="ml-4"><a href="/home" class="grey--text">Més info?</a></v-card-text>
            <v-spacer></v-spacer>
            <v-btn color="primary" type="submit" :disabled="$v.$invalid">Register</v-btn>
        </v-card-actions>
    </v-form>
    <div class="grey lighten-1">
    <v-card-text>
      <v-container text-xs-center>
        <v-layout>
      <v-flex href="/login" xs12 text-xs-center>
        <span class="white--text">Ja tens un compte?</span>
        <a href="/login" class="indigo--text ml-2"><b> LOG IN</b></a>
      </v-flex>
        </v-layout>
       </v-container>
    </v-card-text>
   </div>
   </div>
</template>

<script>
import { validationMixin } from 'vuelidate'
import { required, email, minLength, sameAs } from 'vuelidate/lib/validators'

export default {
  name: 'RegisterForm',
  mixins: [validationMixin],
  validations: {
    dataEmail: { required, email },
    password: { required, minLength: minLength(6) },
      repeatPassword: {
          sameAsPassword: sameAs('password')
      },
      dataName: { required, minLength: minLength(4) }
  },
  data () {
    return {
        dataName: this.name,
      dataEmail: this.email,
      password: '',
        repeatPassword: '',
    }
  },
  props: [ 'name', 'email', 'csrfToken' ],
  computed: {
    emailErrors () {
      const errors = []
      if (!this.$v.dataEmail.$dirty) return errors
      !this.$v.dataEmail.email && errors.push('El camp email ha de ser un email vàlid.')
      !this.$v.dataEmail.required && errors.push('El camp email és obligatori.')
      return errors
    },
    passwordErrors () {
      const errors = []
      if (!this.$v.password.$dirty) return errors
      !this.$v.password.minLength && errors.push('El camp password ha de tenir una mida mínima de 6 caràcters.')
      !this.$v.password.required && errors.push('El camp password és obligatori.')
      return errors
    },
      passwordConfirmationErrors(){
          const errors = []
          !this.$v.repeatPassword.sameAsPassword && errors.push('Els camps password no coincideixen.')
          return errors

      },
      nameErrors () {
          const errors = []
          if (!this.$v.dataName.$dirty) return errors
          !this.$v.dataName.minLength && errors.push('El camp name ha de tenir una mida mínima de 4 caràcters.')
          !this.$v.dataName.required && errors.push('El camp name és obligatori.')
          return errors
      }
  }
}
</script>
