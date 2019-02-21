<template>
  <v-layout align-center column class="text-xs-center">
      <v-icon color="grey lighten-1" style="font-size: 128px;">{{ iicon }}</v-icon>
      <h3 class="grey--text text--darken-2 display-1">{{llabel}}</h3>
      <p class="grey--text text--lighten-1 subheading mb-2 font-weight-light">{{ ddescription }}</p>
      <v-btn color="primary" flat raised v-if="button">{{bbutton}}</v-btn>
  </v-layout>
</template>

<script>
export default {
  name: "EmptyState",
  data() {
    return {
      iicon: this.icon || "",
      llabel: this.label || "Label obligatoria",
      ddescription: this.description || "",
      bbutton: this.button || null
    };
  },
  props: {
    icon: {
      type: String,
      required: false
    },
    label: {
      type: String,
      required: true
    },
    description: {
      type: String,
      required: false
    },
    button: {
      type: String,
      required: false
    }
  }
};
</script>

<style>

</style>
