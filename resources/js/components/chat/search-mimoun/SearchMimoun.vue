<template>
    <v-card flat>
              <v-layout align-center justify-space-around column fill-height>
                <v-flex xs12>
                  <v-text-field
                  color="green"
                    xs12
                    placeholder="Buscar missatges..."
                    class="grey--text"
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
    name: "SearchMimoun",

}
</script>

<style>

</style>
