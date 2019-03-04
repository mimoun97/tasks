<template>
  <v-footer dark height="auto">
    <v-card flat tile class="grey darken-1 white--text text-xs-center">
      <v-card-text>
        <v-btn
          v-ripple="{ class: 'white--text' }"
          v-for="item in social"
          :key="item.name"
          class="mx-3 white--text"
          color="grey lighten-3"
          dark
          icon
          large
          :aria-label="item.name"
        >
          <img style="width:36px;height:36px;" :src="item.icon" :alt="item.name">
        </v-btn>
      </v-card-text>

      <v-card-text
        class="white--text pt-0"
      >Phasellus feugiat arcu sapien, et iaculis ipsum elementum sit amet. Mauris cursus commodo interdum. Praesent ut risus eget metus luctus accumsan id ultrices nunc. Sed at orci sed massa consectetur dignissim a sit amet dui. Duis commodo vitae velit et faucibus. Morbi vehicula lacinia malesuada. Nulla placerat augue vel ipsum ultrices, cursus iaculis dui sollicitudin. Vestibulum eu ipsum vel diam elementum tempor vel ut orci. Orci varius natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus.</v-card-text>

      <v-divider></v-divider>

      <v-card-text class="white--text">
        <p>
          &copy;2018 —
          <strong>Aplicació Tasques</strong>
        </p>
        <div class="white--text ml-3">
          <span>App feta per
            <v-hover>
              <a
                slot-scope="{ hover }"
                :class="`${hover ? 'green' : 'white'}--text`"
                href="https://github.com/mimoun1997"
              >Mimoun Haddou</a>
            </v-hover>
            <span>i amb tot</span>
            <v-icon class="green--text">favorite</v-icon>
            <span>tema i layout fets amb</span>
            <v-hover>
              <a
                slot-scope="{ hover }"
                :class="`${hover ? 'blue' : 'white'}--text`"
                href="https://vuetifyjs.com"
                target="_blank"
                rel="noopener"
              >Vuetify</a>
            </v-hover>
            <span>and</span>
            <v-hover>
              <a
                slot-scope="{ hover }"
                :class="`${hover ? 'orange' : 'white'}--text`"
                href="https://github.com/vwxyzjn"
              >Costa Huang</a>
            </v-hover>
          </span>
        </div>
      </v-card-text>
    </v-card>
  </v-footer>
</template>
<script>
export default {
  data: () => ({
    social: [
      { icon: "/svg/facebook-box.svg", name: "facebook" },
      { icon: "/svg/google-plus.svg", name: "gplus" },
      { icon: "/svg/linkedin-box.svg", name: "linkedin" },
      { icon: "/svg/twitter.svg", name: "twitter" },
      { icon: "/svg/instagram.svg", name: "instagram" }
    ]
  })
};
</script>

<style>
</style>
