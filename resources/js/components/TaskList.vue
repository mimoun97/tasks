<template>
  <div>
    <v-toolbar color="primary lighten-1">
      <v-menu>
        <v-btn slot="activator" icon dark>
          <v-icon>more_vert</v-icon>
        </v-btn>
        <v-list v-for="i in 5" :key="i">
          <v-list-tile>
            <v-list-tile-title>Opció {{ i }}</v-list-tile-title>
          </v-list-tile>
        </v-list>
      </v-menu>
      <v-toolbar-title class="white--text">Tasques</v-toolbar-title>
      <v-spacer></v-spacer>
      <v-btn icon class="white--text">
        <v-icon>settings</v-icon>
      </v-btn>
      <v-btn icon class="white--text" @click="refresh" :loading="loading" :disabled="loading">
        <v-icon>refresh</v-icon>
      </v-btn>
    </v-toolbar>

    <v-card>
      <v-card-title class="mx-2">
        <v-layout row wrap>
          <v-flex lg3 class="mr-2">
            <v-select label="Filtres" :items="filters" v-model="filter" item-text="name"></v-select>
          </v-flex>
          <v-flex lg4 class="mr-2">
            <v-select label="User" :items="dataUsers" v-model="user" item-text="name" clearable></v-select>
          </v-flex>
          <v-flex lg5>
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
        :items="dataTasks"
        :search="search"
        no-results-text="No s'ha trobat cap registre coincident"
        no-data-text="No hi han dades disponibles"
        rows-per-page-text="Tasques per pàgina"
        :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
        :loading="loading"
        :pagination.sync="pagination"
        class="hidden-md-and-down"
      >
        <v-progress-linear slot="progress" color="primary" indeterminate></v-progress-linear>
        <template slot="items" slot-scope="{item: task}">
          <tr>
            <td>{{ task.id }}</td>
            <td v-text="task.name"></td>
            <td>
              <v-avatar :title="task.user_name" size="48">
                <img v-if="task.user_gravatar" :src="task.user_gravatar" alt="avatar">
                <img v-else src="/img/default.png" alt="avatar">
              </v-avatar>
            </td>
            <td>
              <toggle :value="task.completed" uri="/api/v1/completed_task" active-text="Completada" unactive-text="Pendent" :resource="task"></toggle>
              <!-- <task-completed-toggle :task="task"></task-completed-toggle> -->
            </td>
            <td>
              <tasks-tags :task="task" :task-tags="task.tags" :tags="tags" @change="refresh(false)"></tasks-tags>
            </td>
            <td v-text="task.created_at_human"></td>
            <td v-text="task.updated_at_human"></td>
            <td>
              <task-show :users="users" :task="task" :uri="uri"></task-show>
              <task-update :users="users" :task="task" @updated="updateTask" :uri="uri"></task-update>
              <task-destroy :task="task" @removed="removeTask" :uri="uri"></task-destroy>
            </td>
          </tr>
        </template>
      </v-data-table>
      <v-data-iterator
        class="hidden-lg-and-up"
        :items="dataTasks"
        :search="search"
        no-results-text="No s'ha trobat cap registre coincident"
        no-data-text="No hi han dades disponibles"
        rows-per-page-text="Tasques per pàgina"
        :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
        :loading="loading"
        :pagination.sync="pagination"
      >
        <task-card
          class="mx-2"
          slot="item"
          slot-scope="{item:task}"
          :task="task"
          @removed="removeTask"
          @updated="updateTask"
          :uri="uri"
          :users="users"
        ></task-card>
      </v-data-iterator>
    </v-card>
  </div>
</template>

<script>
import Toggle from "./Toggle";
import TaskDestroy from "./TaskDestroy";
import TaskUpdate from "./TaskUpdate";
import TaskShow from "./TaskShow";
import TasksTags from "./TasksTags";
import TaskCard from "./TaskCard";

export default {
  name: "TaskList",
  data() {
    return {
      user: "",
      loading: false,
      dataTasks: this.tasks,
      dataUsers: this.users,
      filter: "Totes",
      filters: ["Totes", "Completades", "Pendents"],
      search: "",
      pagination: {
        rowsPerPage: 25
      },
      headers: [
        { text: "Id", value: "id" },
        { text: "Name", value: "name" },
        { text: "User", value: "user_id" },
        { text: "Completat", value: "completed" },
        { text: "Etiquetes", value: "tags" },
        { text: "Creat", value: "created_at_timestamp" },
        { text: "Modificat", value: "updated_at_timestamp" },
        { text: "Accions", sortable: false, value: "full_search" }
      ]
    };
  },
  components: {
    "task-card": TaskCard,
    "task-destroy": TaskDestroy,
    "task-update": TaskUpdate,
    "task-show": TaskShow,
    "tasks-tags": TasksTags,
    "toggle": Toggle
  },
  props: {
    tasks: {
      type: Array,
      required: true
    },
    tags: {
      type: Array,
      required: true
    },
    users: {
      type: Array,
      required: true
    },
    uri: {
      type: String,
      required: true
    }
  },
  watch: {
    tasks(newTasks) {
      this.dataTasks = newTasks;
    }
  },
  methods: {
    removeTask(task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1);
    },
    updateTask(task) {
      this.refresh();
    },
    refresh() {
      this.loading = true;
      window.axios
        .get(this.uri)
        .then(response => {
          this.dataTasks = response.data;
          this.loading = false;
          this.$snackbar.showMessage("Tasques actualitzades correctament");
        })
        .catch(error => {
          this.loading = false;
        });
    }
  }
};
</script>

<style scoped>
</style>
