<template>
  <div>
    <v-hover>
      <v-card mt-5 slot-scope="{ hover }" :class="`elevation-${hover ? 2 : 12}`">
        <v-img src="https://avatars3.githubusercontent.com/u/23049511?s=460&v=4"></v-img>

        <v-card-title primary-title>
          <div>
            <div class="headline">Mimoun Haddou</div>
            <span class="grey--text">Curs 2018/2019</span>
          </div>
        </v-card-title>

        <v-card-actions>
          <v-btn depressed flat color="red">gmail</v-btn>
          <v-btn flat color="purple">Github</v-btn>
          <v-spacer></v-spacer>
          <v-btn icon @click="show = !show">
            <v-icon>{{ show ? 'keyboard_arrow_up' : 'keyboard_arrow_down' }}</v-icon>
          </v-btn>
        </v-card-actions>

        <v-slide-y-transition>
          <v-card-text
            v-show="show"
          >Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptatum, hic, sunt laboriosam animi ipsa nesciunt aperiam incidunt officia quod sit veritatis, quibusdam tempore. Vitae in architecto dolore, eos deserunt iste.</v-card-text>
        </v-slide-y-transition>
      </v-card>
    </v-hover>
  </div>
</template>

<script>
export default {
  name: "Contact",

  data() {
    return {
      show: false
    };
  }
};
</script>

<style lang="css" scoped>
</style>
