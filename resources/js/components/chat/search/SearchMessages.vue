<template>
  <v-card flat>
    <v-layout align-center justify-space-around column fill-height>
      <v-flex xs12>
        <v-text-field
          xs12
          placeholder="Buscar o empezar un chat nuevo"
          class="black--text"
          :prepend-icon="search ? 'search' : 'arrow_back'"
          :full-width="searxh"
          single-line
          solo
          flat
        ></v-text-field>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  name: "SearchMessages",
  data() {
    return {
      search: false
    };
  }
};
</script>

<style>
</style>
