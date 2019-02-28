<template>
  <v-container grid-list-md text-xs-center id="tasks" class="tasks">
    <v-layout column row wrap>
      <v-flex xs12>
        <v-card>
          <v-flex xs12>
            <v-card-title dark class="display-2 indigo--text roboto" color="primary">
              <span v-if="filter">
                Tasques
                <b>
                  ({{totalFiltered}}/
                  <b>{{total}})</b>
                </b>
              </span>
              <span v-else>
                Tasques
                <b>({{total}})</b>
              </span>
            </v-card-title>
          </v-flex>
          <v-card-text class="xs12">
            <div row>
              <v-flex id="filters" v-show="total > 0" xs12>
                <v-card raised row d-inline-block dark class="indigo darken-1">
                  <v-card-text class="headline">
                    Filtre activat:
                    <b :class="colorFiltre">"{{ filter }}"</b>
                  </v-card-text>
                  <v-card-actions class="justify-center">
                    <v-btn @click="setFilter('all')">Totes</v-btn>
                    <v-btn class="green" @click="setFilter('completed')">Completades</v-btn>
                    <v-btn class="orange" @click="setFilter('active')">Pendents</v-btn>
                  </v-card-actions>
                </v-card>
              </v-flex>
            </div>
            <form class="block">
              <v-layout></v-layout>
              <v-text-field type="text" v-model="newTask" @keyup.enter="add" name="name" required></v-text-field>
              <v-btn block dark class="indigo" id="button_add_task" @click="add">Afegir</v-btn>
            </form>

            <div v-if="errorMessage">Ha succeit un error: {{ errorMessage }}</div>
            <v-list dense>
              <v-list-tile v-for="task in filteredTasks" :key="task.id">
                <v-list-tile-content>
                  <v-list-tile-title
                    :id="'task' + task.id"
                    :class="{ strike: task.completed && editing}"
                  >
                    <editable-text
                      :class="{ 'orange--text': !task.completed }"
                      :text="task.name"
                      @editing="editing=true"
                      @edited="editName(task, $event)"
                    ></editable-text>
                    <v-btn icon @click="remove(task)">
                      <v-icon color="error">delete</v-icon>
                    </v-btn>
                    <v-btn icon type="checkbox" name="checked" @click="toggle(task)">
                      <v-icon v-if="task.completed" color="green">check_box</v-icon>
                      <v-icon v-else color="orange">check_box_outline_blank</v-icon>
                    </v-btn>
                  </v-list-tile-title>
                </v-list-tile-content>
              </v-list-tile>
            </v-list>
          </v-card-text>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
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
    }
  },
  watch: {
    tasks(newTasks) {
      this.dataTasks = newTasks;
    }
  },
  methods: {
    editName(task, text) {
      task.name = text;
    },
    setFilter(newFilter) {
      this.filter = newFilter;
    },
    add() {
      if (this.newTask === "") return;
      window.axios
        .post("/api/v1/tasks", {
          name: this.newTask
        })
        .then(response => {
          this.dataTasks.splice(0, 0, {
            id: response.data.id,
            name: this.newTask,
            completed: false
          });
          this.newTask = "";
        })
        .catch(error => {
          console.log(error);
        });
    },
    remove(task) {
      this.dataTasks.splice(this.dataTasks.indexOf(task), 1);
    }
  },
  created() {
    if (this.tasks.length === 0) {
      window.axios
        .get("/api/v1/tasks")
        .then(response => {
          //console.log(response.data)
          this.dataTasks = response.data;
        })
        .catch(error => {
          this.errorMessage = error.response.data;
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
