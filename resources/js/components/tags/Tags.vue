<template>
    <v-layout>
        <tags-create @created="add"></tags-create>
        <tags-list v-if="noZeroTags" :tags="dataTags" ></tags-list>

        <empty-state v-else
                    label="Crea la teva primera etiqueta!" 
                    icon="loyalty" 
                    description="Si creeu una etiqueta, podreu afegir assignar-la a una tasca i poder col·laborar amb les persones."
                    >
        </empty-state>
    </v-layout>
</template>

<script>
import TagsCreate from "./TagsCreate";
import TagsList from "./TagsList";

export default {
  name: 'Tags',
  components: {
    "tags-create": TagsCreate,
    "tags-list": TagsList,
  },
  data () {
    return {
      dataTags: this.tags
    }
  },
  methods: {
    add (tag) {
      this.dataTags.push(tag)
    }
  },
  props: ['tags'],
  computed: {
    noZeroTags: function () {
      // `this` points to the vm instance
      //console.log('HOLA TRUE?' + this.dataTasks.length)
      return this.dataTags.length !== 0
    }
  }
}
</script>
