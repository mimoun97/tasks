<template>
    <div>
        <v-btn @click="showMessage" >Hola</v-btn>
        <v-btn @click="showError" >Adeu</v-btn>

        <v-list>
            <template v-for="tag in dataTags">
                <v-card>
                <v-subheader>{{ tag.name }}</v-subheader>

                <v-list-tile>{{ tag.description }}</v-list-tile>
                <v-list-tile>{{ tag.color }}</v-list-tile>
                    <v-divider

                            :key="index"
                    ></v-divider>
                </v-card>
            </template>
        </v-list>
    </div>
</template>

<script>

    export default {
        name: "Tags",
        data (){
            return {
                dataTags: this.tags
            }
        },
        methods: {
            showMessage () {
                console.log('blablasdas')
                this.$snackbar.showMessage('Crea creada correctament')
            },
            showError () {
                console.log('adeu')
                this.$snackbar.showError('Missatge error')
            }
        },
        props: ['tags']
    }
</script>
