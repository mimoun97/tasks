<template>
    <div>
        <h2>HOLA</h2>
        <!--TODO etiquetes-->
        <v-chip v-for="tag in task.tags" :key="tag.id" v-text="tag.name"> </v-chip>

        <v-dialog v-model="dialog" width="500">
            <v-card>
                <v-card-title>Afegiu etiquetes..</v-card-title>
                <v-card-actions>
                    <v-btn>Afegir</v-btn>
                    <v-btn>Cancelar</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>
    </div>
</template>

<script>
export default {
  name: 'TasksTags',
  data () {
    return {
      value: ''
    }
  },
  props: {
    task: {
      required: true,
      type: Object
    }
  }
}
</script>

<style scoped>

</style>
