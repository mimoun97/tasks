<template>
    <v-card flat class="my-2">
        <v-card-title v-text="tag.name"></v-card-title>
        <v-list dense>
            <v-list-tile>
                <v-list-tile-content>Descripció:</v-list-tile-content>
                <v-list-tile-content class="align-end">{{ tag.description }}</v-list-tile-content>
            </v-list-tile>
            <v-list-tile>
                <v-list-tile-content>Etiqueta:</v-list-tile-content>
                <v-list-tile-content class="align-end">{{ tag.task_id }}</v-list-tile-content>
            </v-list-tile>                    
        </v-list>                 
    </v-card>
</template>

<script>
export default {
    name: 'TagCard'
}
</script>

<style>

</style>
