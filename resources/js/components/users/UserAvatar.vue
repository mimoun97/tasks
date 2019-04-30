<template>
    <v-tooltip bottom>
        <span slot="activator">
            <v-avatar class="mt-1 mb-1" :size="size" @click="$emit('click')">
                <img
                        :src="imageUrl()"
                        :alt="dataAlt"
                >
            </v-avatar>
        </span>
        <span v-text="dataAlt"></span>
    </v-tooltip>
</template>

<script>
import interactsWithGravatar from '../mixins/interactsWithGravatar'

export default {
  name: 'UserPhoto',
  mixins: [ interactsWithGravatar ],
  data () {
    return {
      dataAlt: ''
    }
  },
  props: {
    user: {
      type: Object,
      required: true
    },
    size: {
      type: String,
      default: '100px'
    },
    alt: {
      required: false
    }
  },
  methods: {
    imageUrl () {
      if (this.user.avatar) {
        if (this.user.avatar_hash) {
          return '/user/' + this.user.hashid + '/avatar?' + this.user.avatar_hash
        }
        return '/user/' + this.user.hashid + '/avatar'
      }
      if (this.user.photo) {
        if (this.user.photo_hash) {
          return '/user/' + this.user.hashid + '/photo?' + this.user.photo_hash
        }
        return '/user/' + this.user.hashid + '/photo'
      }
      return this.gravatarURL(this.user.email)
    },
    initializeDataAlt () {
      if (this.alt) this.dataAlt = this.alt
      else {
        this.dataAlt = this.user.email
      }
    }
  },
  created () {
    this.initializeDataAlt()
  }
}
</script>
