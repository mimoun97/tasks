<template>
  <v-card>
    <v-card-title dark class="display-2 indigo--text roboto" color="primary">
      <div v-if="filter">
        Tasques
        <b>
          ({{totalFiltered}}/
          <b>{{total}})</b>
        </b>
      </div>
      <div v-else>
        Tasques
        <b>({{total}})</b>
      </div>
    </v-card-title>

    <v-card-text class="text-xs-center">
      <v-card raised row d-inline-block dark class="indigo darken-1">
        <v-card-text class="headline text-xs-center">
          Filtre activat:
          <b :class="colorFiltre">"{{ filter }}"</b>
        </v-card-text>
        <v-card-actions v-show="total > 0" xs12>
          <v-layout justify-space-around row>
            <v-flex>
              <v-btn @click="setFilter('all')">Totes</v-btn>
            </v-flex>
            <v-flex>
              <v-btn class="green" @click="setFilter('completed')">Completades</v-btn>
            </v-flex>
            <v-flex>
              <v-btn class="orange" @click="setFilter('active')">Pendents</v-btn>
            </v-flex>
          </v-layout>
        </v-card-actions>
      </v-card>
    </v-card-text>

    <v-card-text class="text-xs-center">
      <form>
        <v-layout></v-layout>
        <v-text-field
          hint="Afegix una tasca"
          label="Tasca.."
          type="text"
          v-model="newTask"
          @keyup.enter="add"
          name="name"
          required
          color="indigo"
        ></v-text-field>
        <v-btn block dark color="indigo" id="button_add_task" @click="add">Afegir</v-btn>
      </form>
      <v-alert
        v-if="errorMessage"
        :value="true"
        type="error"
        outline
      >Ha succeit un error: {{ errorMessage }}</v-alert>
    </v-card-text>

    <v-card-text>
      <v-list>
        <v-list-tile v-for="task in filteredTasks" :key="task.id">
          <v-list-tile-content>
            <v-list-tile-title :id="'task' + task.id" :class="{ strike: task.completed && editing}">
              <v-layout row justify-space-between>
                <v-flex xs8 md9>
                  <editable-text
                    :class="{ 'grey--text': !task.completed}"
                    :text="task.name"
                    @editing="editing=true"
                    @edited="editName(task, $event)"
                  ></editable-text>
                </v-flex>
                <v-layout>
                  <v-flex xs4 md3>
                    <v-btn icon @click="remove(task)">
                      <v-icon color="error">delete</v-icon>
                    </v-btn>
                    <v-btn
                      color="grey lighten-4"
                      icon
                      dark
                      type="checkbox"
                      name="checked"
                      @click="task.completed = !task.completed"
                    >
                      <v-icon v-if="task.completed" color="green">check_box</v-icon>
                      <v-icon v-else color="orange">check_box_outline_blank</v-icon>
                    </v-btn>
                  </v-flex>
                </v-layout>
              </v-layout>
            </v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-card-text>
  </v-card>
</template>

<script>
import EditableText from "./EditableText";

var filters = {
  all: function(tasks) {
    return tasks;
  },
  completed: function(tasks) {
    return tasks.filter(function(task) {
      return task.completed;
    });
  },
  active: function(tasks) {
    return tasks.filter(function(task) {
      return !task.completed;
    });
  }
};

export default {
  name: "Tasks",
  components: {
    "editable-text": EditableText
  },
  data() {
    return {
      editing: false,
      filter: "all", // All Completed Active
      newTask: "",
      dataTasks: this.tasks,
      errorMessage: ""
    };
  },
  props: {
    tasks: {
      type: Array,
      default: function() {
        return [];
      }
    }
  },
  computed: {
    total() {
      return this.dataTasks.length;
    },
    filteredTasks() {
      // Segons el filtre actiu
      // Alternativa switch/case -> array associatiu
      return filters[this.filter](this.dataTasks);
    },
    totalFiltered() {
      return filters[this.filter](this.dataTasks).length;
    },
    colorFiltre: function() {
      return {
        "black--text": this.filter == "all",
        "green--text": this.filter == "completed",
        "orange--text": this.filter == "active"
      };
    },
    user: function() {
      return window.laravel_user;
    }
  },
  watch: {
    tasks(newTasks) {
      this.dataTasks = newTasks;
    }
  },
  methods: {
    completeTask() {
      window.axios.post("api/v1/completed_task/" + task.id);
      this.$snackbar.showMessage("Tasca completada");
    },
    uncompleteTask() {
      window.axios.delete("api/v1/completed_task/" + task.id);
      this.$snackbar.showMessage("Tasca descompletada");
    },
    clearFields() {},
    editName(task, text) {
      task.name = text;
    },
    setFilter(newFilter) {
      this.filter = newFilter;
    },
    add() {
      if (this.newTask === "") return;
      var task = {
        name: this.newTask,
        description: "Descripció de " + this.newTask,
        user_id: this.user.id
      };
      window.axios
        .post("/api/v1/tasks", task)
        .then(response => {
          this.dataTasks.splice(0, 0, {
            id: response.data.id,
            name: response.data.name,
            completed: response.data.completed,
            user_id: response.data.user_id
          });
          this.newTask = "";
          this.$snackbar.showMessage("Tasques actualitzades correctament");
        })
        .catch(error => {
          this.$snackbar.showError(error);
        });
    },
    remove(task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1);
    },
    toggle(task) {
      task.completed ? this.uncompleteTask() : this.completeTask();
    }
  },
  created() {
    if (this.tasks.length === 0) {
      window.axios
        .get("/api/v1/tasks")
        .then(response => {
          this.$snackbar.showMessage("Tasques actualitzades correctament");
          this.dataTasks = response.data;
        })
        .catch(error => {
          this.$snackbar.showMessage(error.message);
        });
    }
  }
};
</script>

<style scoped>
.strike {
  text-decoration: line-through;
}
</style>
