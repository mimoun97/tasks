<template>
  <v-autocomplete
    :readonly="readOnly"
    :items="dataUsers"
    v-model="selectedUser"
    :item_value="itemValue"
    :clearable="!readOnly"
    :label="label"
  >
    <template slot="selection" slot-scope="data">
      <v-chip>
        <v-avatar :title="data.item.name">
          <img :src="gravatar(data.item)" :alt="data.item.name">
        </v-avatar>
        <b>{{ data.item.gravatar }}</b>
        {{ data.item.name }}
      </v-chip>
    </template>
    <template slot="item" slot-scope="{ item: user }">
      <v-list-tile-avatar>
        <v-avatar size="40" :title="user.name">
          <img :src="gravatar(user)" alt="avatar">
        </v-avatar>
      </v-list-tile-avatar>
      <v-list-tile-content>
        <v-list-tile-title v-text="user.name"></v-list-tile-title>
        <v-list-tile-sub-title v-text="user.email"></v-list-tile-sub-title>
      </v-list-tile-content>
    </template>
  </v-autocomplete>
</template>

<script>
export default {
  name: "UserSelect",
  data() {
    return {
      dataUsers: this.users,
      selectedUser: this.user
    };
  },
  model: {
    prop: "user",
    event: "selected"
  },
  props: {
    readOnly: {
      type: Boolean,
      default: false
    },
    itemValue: {
      type: String,
      default: "id"
    },
    user: {
      type: Object,
      default: function() {
        return {};
      }
    },
    users: {
      type: Array,
      required: true
    },
    label: {
      type: String,
      default: "Usuaris"
    }
  },
  watch: {
    user(user) {
      this.selectedUser = user;
    },
    selectedUser(newValue) {
      this.$emit("selected", newValue);
    },
    users() {
      this.dataUsers = this.users;
    }
  },
  methods: {
    gravatar: function(user) {
      return ("https://www.gravatar.com/avatar/" + window.md5(user ? user.email : "google@gmail.com") + "?s=40");
    }
  }
};
</script>
