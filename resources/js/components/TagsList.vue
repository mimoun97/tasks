<template>
  <div>
    <v-toolbar color="primary lighten-1">
      <v-menu>
        <v-btn slot="activator" icon dark>
          <v-icon>more_vert</v-icon>
        </v-btn>
        <v-list>
          <v-list-tile>
            <v-list-tile-title>Opció 1</v-list-tile-title>
          </v-list-tile>
          <v-list-tile href="http://github.com/mimoun1997">
            <v-list-tile-title>mimoun1997</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-toolbar-title class="white--text">Tags</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon class="white--text">
        <v-icon>settings</v-icon>
      </v-btn>
      <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
        <v-icon>refresh</v-icon>
      </v-btn>
    </v-toolbar>

    <v-card>
      <v-card-title>
        <v-layout row wrap>
          <v-flex lg5 class="mx-2">
            <v-text-field append-icon="search" label="Buscar" v-model="search"></v-text-field>
          </v-flex>
        </v-layout>
      </v-card-title>
      <v-data-table
        :headers="headers"
        :items="dataTags"
        :search="search"
        no-results-text="No s'ha trobat cap registre coincident"
        no-data-text="No hi han dades disponibles"
        rows-per-page-text="Tasques per pàgina"
        :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
        :loading="loading"
        :pagination.sync="pagination"
        class="hidden-md-and-down"
      >
        <v-progress-linear slot="progress" color="secondary" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="{item: tag}">
          <tr>
            <td v-text="tag.id"></td>
            <td>
              <v-chip dark :color="tag.color">{{tag.name}}</v-chip>
            </td>
            <td v-text="tag.description"></td>
            <td v-text="tag.created_at_human"></td>
            <td v-text="tag.updated_at_human"></td>

            <td>
              <tag-show :tag="tag"></tag-show>
              <tag-update :tag="tag" @updated="updateTag"></tag-update>
              <tag-destroy :tag="tag" @removed="removeTag"></tag-destroy>
            </td>
          </tr>
        </template>
      </v-data-table>
      <v-data-iterator
        class="hidden-lg-and-up"
        :items="dataTags"
        :search="search"
        no-results-text="No s'ha trobat cap registre coincident"
        no-data-text="No hi han dades disponibles"
        rows-per-page-text="Etiquetes per pàgina"
        :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
        :loading="loading"
        :pagination.sync="pagination"
      >
        <v-card slot="item" slot-scope="{item:tag}" xs12 class="my-1 mx-2">
          <v-card-title class="title grey--text text--darken-1 my-2">
            <v-chip dark :color="tag.color" class="title">{{tag.name}}</v-chip>
          </v-card-title>
          <v-card-text class="content grey--text text--darken-4 my-2" v-text="tag.description"></v-card-text>
          <v-card-actions class="hidden-xs">
            <v-layout column class="ml-3" align-start>
              <v-list-tile-content class="grey--text text--darken-4">{{ tag.user_name }}</v-list-tile-content>
              <v-list-tile-content
                class="grey--text text--darken-4"
              >Creat {{ tag.created_at_human }}</v-list-tile-content>
              <v-list-tile-content
                class="grey--text text--darken-1"
              >Ultima actualització {{tag.updated_at_human}}</v-list-tile-content>
            </v-layout>
            <v-layout column align-end justify-space-between>
              <v-flex mb-2>
                <tag-show :tag="tag"></tag-show>
              </v-flex>
              <v-flex mb-2>
                <tag-destroy :tag="tag" @removed="removeTag"></tag-destroy>
              </v-flex>
              <v-flex mb-2>
                <tag-update :tag="tag" @updated="updateTag"></tag-update>
              </v-flex>
            </v-layout>
          </v-card-actions>
        </v-card>
      </v-data-iterator>
    </v-card>
  </div>
</template>

<script>
import TagDestroy from "./TagDestroy";
import TagUpdate from "./TagUpdate";
import TagShow from "./TagShow";

export default {
  name: "TagsList",
  components: {
    "tag-destroy": TagDestroy,
    "tag-update": TagUpdate,
    "tag-show": TagShow
  },
  props: {
    tags: {
      type: Array,
      required: true
    }
  },
  data() {
    return {
      tag: null,
      dataTags: this.tags,
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      search: "",
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: "Id", value: "id" },
        { text: "Name", value: "name" },
        { text: "Descripció", value: "description" },
        { text: "Creat", value: "created_at_timestamp" },
        { text: "Modificat", value: "updated_at_timestamp" },
        { text: "Accions", sortable: false, value: "full_search" }
      ]
    };
  },
  methods: {
    refresh() {
      this.loading = true;
      window.axios
        .get("/api/v1/tags")
        .then(response => {
          this.dataTags = response.data;
          this.loading = false;
          this.$snackbar.showMessage("Etiquetes actualitzades correctament");
        })
        .catch(error => {
          this.loading = false;
          this.$snackbar.showError(error);
        });
    },
    updateTag(tag) {
      this.refresh();
    },
    removeTag(tag) {
      this.dataTags.splice(this.dataTags.indexOf(tag), 1);
    },
    // TODO debounceSearch 
    debounceSearch(text){
      return text
    }
  },
  watch: {
    tags: function(newTags, oldTags) {
      this.dataTags = newTags;
    }
  },
  created() {
    this.debounceSearch = _.debounce(this.debounceSearch, 500);
  },
};
</script>

<style>
</style>
