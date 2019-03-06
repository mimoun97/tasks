<template>
  <v-carousel hide-delimiters vertical hide-controls cycle>
    <v-carousel-item v-for="(item,i) in items" :key="i" :src="item.src" lazy></v-carousel-item>
  </v-carousel>
</template>

<script>
export default {
  name: "Carrusel",
  data() {
    return {
      items: [
        {
          src: "img/sky.jpeg"
        },
        {
          src: "img/tests.gif"
        },
        {
          src: "img/tests2.gif"
        },
        {
          src: "img/capturatasks.PNG"
        }
      ]
    };
  }
};
</script>

<style>
</style>
