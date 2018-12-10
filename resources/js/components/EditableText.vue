<template>
    <span>
        <span v-if="!editing" @dblclick="editing=true">
            {{ currentText }}
        </span>
        <span v-if="editing" @keyup.esc="editing=false"
              @keyup.enter="edit">
            <input type="text" v-model="currentText">
        </span>
    </span>
</template>

<script>

export default {
  name: 'EditableText',
  data () {
    return {
      editing: false,
      currentText: this.text
    }
  },
  props: {
    'text': {
      type: String,
      required: true
    }
  },
  watch: {
    text (newText) {
      this.currentText = this.text
    }
  },
  // props: ['text'],
  methods: {
    edit () {
      this.editing = false
      // INFORMAR AL PARE
      this.$emit('edited', this.currentText)
    }
  },
  created () {
    // console.log('Component EditableText ha estat creat');
  }
}

</script>
