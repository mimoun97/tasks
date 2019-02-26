<template>
  <compact-picker @input="updateColor" :value="colors" :palette="colors"></compact-picker>
</template>

<script>
import { Compact } from 'vue-color'
export default {
    name: 'SettingsColor',
    components: {
        'compact-picker': Compact
    },
    data() {
        return {
            colors: [
                '#F44336',
                '#E91E63',
                '#9C27B0',
                '#673AB7',
                '#3F51B5',
                '#2196F3',
                '#1976d2',
                '#03A9F4',
                '#00BCD4',
                '#009688',
                '#4CAF50',
                '#8BC34A',
                '#CDDC39',
                '#FFEB3B',
                '#FFC107',
                '#FF9800',
                '#FF5722',
                '#795548',
                '#607D8B',
                '#9E9E9E',
                '#4C63B6',
            ]
        }
    },
    methods: {
        updateColor: function updateColor(newColor) {
            this.$emit('updateColor', newColor.hex)
        }
    }
  }
</script>

<style>
</style>