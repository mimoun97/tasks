<template>
  <v-carousel hide-delimiters cycle>
    <v-carousel-item
      v-for="(item,i) in items"
      :key="i"
      :src="item.src"
    ></v-carousel-item>
  </v-carousel>
</template>

<script>
  export default {
    name: 'Carrusel',
    data () {
      return {
        items: [
          {
            src: 'img/default.png'
          },
          {
            src: 'img/Octocat.png'
          },
          {
            src: 'img/og-image.jpg'
          },
          {
            src: 'img/tests.gif'
          },
          {
            src: 'img/tests2.gif'
          },
          {
            src: 'img/capturatasks.PNG'
          }
        ]
      }
    }
  }
</script>

<style>

</style>
