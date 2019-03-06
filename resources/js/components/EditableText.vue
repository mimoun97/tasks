<template>
  <div>
    <div v-if="!editing" @dblclick="editing=true">{{ currentText }}</div>
    <div v-if="editing" @keyup.esc="editing=false" @keyup.enter="edit">
      <v-flex xs12>
        <input type="text" v-model="currentText">
      </v-flex>
    </div>
  </div>
</template>

<script>
export default {
  name: "EditableText",
  data() {
    return {
      editing: false,
      currentText: this.text
    };
  },
  props: {
    text: {
      type: String,
      required: true
    }
  },
  watch: {
    text(newText) {
      this.currentText = this.text;
    },
    editing(newVal) {
      this.$emit("editing", newVal);
    }
  },
  // props: ['text'],
  methods: {
    edit() {
      this.editing = false;
      // INFORMAR AL PARE
      this.$emit("edited", this.currentText);
    }
  },
  created() {}
};
</script>
