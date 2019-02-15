<template>
  <v-footer
    dark
    height="auto"
  >
    <v-card
      flat
      tile
      class="grey darken-1 white--text text-xs-center"
    >
      <v-card-text>
        <v-btn v-for="icon in icons"
          :key="icon"
          class="mx-3 white--text"
          dark
          color="grey lighten-1"
          icon>
            <img style="width:24px;height:24px;color:white" :src="icon" />
        </v-btn>
      </v-card-text>

      <v-card-text class="white--text pt-0">
        Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.
      </v-card-text>

      <v-divider></v-divider>

      <v-card-text class="white--text">
        <p>&copy;2018 — <strong>Aplicació Tasques</strong></p>
            <div class="white--text ml-3">
                            App feta per <a class="white--text" href="https://github.com/mimoun1997"> Mimoun Haddou</a>

                            i amb tot <v-icon class="red--text">favorite</v-icon> tema i layout fets amb <a class="white--text" href="https://vuetifyjs.com" target="_blank">Vuetify</a>
                            and <a class="white--text" href="https://github.com/vwxyzjn">Costa Huang</a>
            </div>
      </v-card-text>
    </v-card>
  </v-footer>
</template>

<script>
  export default {
    data: () => ({
      icons: [
        '/svg/facebook-box.svg',
        '/svg/google-plus.svg',
        '/svg/linkedin-box.svg',
        '/svg/twitter.svg',
        '/svg/instagram.svg'
      ]
    })lighten
  }
</script>

<style>

</style>
