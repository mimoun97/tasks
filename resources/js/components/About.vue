<template>
  <v-timeline>
    <v-timeline-item
      v-for="(pagina, i) in paginas"
      :color="pagina.color"
      :key="i"
      small
    >
      <span
        slot="opposite"
        :class="`headline font-weight-bold ${pagina.color}--text`"
        v-text="pagina.any"
      ></span>
      <div class="py-3">
        
        <div><b :class="`${pagina.color}--text`">{{ pagina.content }}</b>
          Lorem ipsum dolor sit amet, no nam oblique veritus. Commune scaevola imperdiet nec ut, sed euismod convenire principes at. Est et nobis iisque percipit, an vim zril disputando voluptatibus, vix an salutandi sententiae.
        </div>
      </div>
    </v-timeline-item>
  </v-timeline>
</template>
<script>
  export default {
    name: 'About',
    data: () => ({
      paginas: [
      {
          title: 'About i Contact',
          content: 'Pàgines estàtiques amb components vue',
          color: 'orange',
          any: 'About i Contact'
        },
        {
          title: 'Tags',
          content: 'Tags amb vue, vuetify',
          color: 'amber',
          any: 'Tags'
        },
        {
          title: 'Tasques amb PHP i Tailwind',
          content: 'Tasques PHP BLA BLA BLA',
          color: 'cyan',
          any: 'Tasques amb PHP i Tailwind'
        },
        {
          title: 'Tasques Vue',
          content: 'Tasques PHP BLA BLA BLA',
          color: 'green',
          any: 'Tasques Vue'
        },
        {
          title: 'Tasques',
          content: 'Tasques amb vue, vuetify',
          color: 'pink',
          any: 'Tasques'
        }
      ]
    })
  }
</script>