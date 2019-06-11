<template>
  <v-card flat>
    <v-layout align-center justify-space-between fill-height my-3>
      <v-flex xs2>
        <v-icon @click="clear" color="green">{{ readOnly ?  'search' : 'arrow_back' }}</v-icon>
      </v-flex>
      <v-flex xs10>
        <input type="text" id="rounded" placeholder="Buscar o empezar un chat..." readonly="readOnly" v-show="readOnly" >
        <v-text-field flat v-model="search" v-show="!readOnly" single-line color="green" ref='input' class="mr-2"></v-text-field>
      </v-flex>
    </v-layout>
  </v-card>
</template>

<script>
export default {
  name: "SearchMimoun",
  data() {
    return {
      search: '',
      readOnly: true
    };
  },
  methods: {
    clear () {
      this.search = ''
      this.readOnly = !this.readOnly

      setTimeout(() => {
        this.$refs.input.focus();
      }, 150);
      
    }
  },
};
</script>

<style scoped>
#rounded {
  border: 1px solid #ccc;
  -moz-border-radius: 10px;
  -webkit-border-radius: 10px;
  border-radius: 30px;
  /**-moz-box-shadow: 2px 2px 3px #666;
	-webkit-box-shadow: 2px 2px 3px #666;
	box-shadow: 2px 2px 3px #666;**/
  font-size: 16px;
  padding: 4px 7px;
  outline: 0;
  -webkit-appearance: none;
  background-color: rgb(248, 248, 248);
}
#rounded:focus {
  border-color: #339933;
  background-color: white;
}
</style>
