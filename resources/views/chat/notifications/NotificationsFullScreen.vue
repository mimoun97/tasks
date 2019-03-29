<template>
    <v-layout align-center justify-center row fill-height>
      <v-flex>
      <v-dialog v-model="dialog" fullscreen transition="dialog-bottom-transition">
        <v-card color="rgb(0, 0, 0, 0.8)">
          <v-btn @click="dialog = false">exit</v-btn>
        </v-card>
      </v-dialog>
        </v-flex>
    </v-layout>
</template>

<script>
export default {
    name: 'NotificationsFullScreen',
    data () {
        return {
            dataDialog: this.dialog
        }
    },
    props: {

    }
}
</script>

<style>

</style>
