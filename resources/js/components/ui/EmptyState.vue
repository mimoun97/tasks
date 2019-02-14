<template>
    <div>
         <md-empty-state
            class="md-accent"
            :md-icon="icon"
            :md-label="label"
            :md-description="description">
            <v-btn v-if="button" color="primary" flat>{{ button }}</v-btn>
        </md-empty-state>
    </div>
</template>

<script>



export default {
    name: 'EmptyState',
    data () {
        return {
            icon: this.icon || '',
            label: this.label || 'Label obligatoria',
            description: this.description || '',
            button: this.button || null,
        }
    },
    props: {
        'icon': {
            type: String,
            required: false
        },
        'label': {
            type: String,
            required: true
        },
        'description': {
            type: String,
            required: false
        },
        'button': {
            type: String,
            required: false
        },


  },
}
</script>

<style scoped>

</style>