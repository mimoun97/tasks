<template>
    <div>
        <v-toolbar color="primary">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile @click="opcio1">
                        <v-list-tile-title>Opció 1</v-list-tile-title>
                    </v-list-tile>
                    <v-list-tile href="http://github.com/mimoun1997">
                        <v-list-tile-title>mimoun1997</v-list-tile-title>
                    </v-list-tile>
                </v-list>
            </v-menu>
            <v-toolbar-title class="white--text">Tags</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn icon class="white--text">
                <v-icon>settings</v-icon>
            </v-btn>
            <v-btn icon class="white--text">
                <v-icon>refresh</v-icon>
            </v-btn>
        </v-toolbar>

        <v-card>
            <v-card-title>
                <v-layout row wrap>
                    <v-flex lg5 class="mx-2">
                        <v-text-field
                                append-icon="search"
                                label="Buscar"
                                v-model="search"
                        ></v-text-field>
                    </v-flex>
                </v-layout>
            </v-card-title>
            <v-data-table
                    :headers="headers"
                    :items="dataTags"
                    :search="search"
                    no-results-text="No s'ha trobat cap registre coincident"
                    no-data-text="No hi han dades disponibles"
                    rows-per-page-text="Tasques per pàgina"
                    :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                    :loading="loading"
                    :pagination.sync="pagination"
                    class="hidden-md-and-down"
            >
                <v-progress-linear slot="progress" color="blue" indeterminate></v-progress-linear>
                <template slot="items" slot-scope="{item: task}">
                    <tr>
                        <td>{{ tag.id }}</td>
                        <td v-text="tag.name"></td>
                        <td v-text="tag.created_at_human"></td>
                        <td v-text="tag.updated_at_human"></td>
                        <td>
                            <v-btn icon color="primary" flat title="Mostrar snackbar"
                                   @click="snackbar=true">
                                <v-icon>info</v-icon>
                            </v-btn>
                            <v-btn icon color="primary" flat title="Mostrar la tasca"
                                   @click="show(tag)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Canviar la tasca"
                                   @click="showUpdate(tag)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn v-can="tasks.destroy" icon color="error" flat title="Eliminar la tasca"
                                   @click="showDestroy(tag)">
                                <v-icon>delete</v-icon>
                            </v-btn>
                        </td>
                    </tr>
                </template>
            </v-data-table>
            <v-data-iterator class="hidden-lg-and-up"
                             :items="dataTags"
                             :search="search"
                             no-results-text="No s'ha trobat cap registre coincident"
                             no-data-text="No hi han dades disponibles"
                             rows-per-page-text="Etiquetes per pàgina"
                             :rows-per-page-items="[5,10,25,50,100,200,{'text':'Tots','value':-1}]"
                             :loading="loading"
                             :pagination.sync="pagination"
            >
                <v-flex
                        slot="item"
                        slot-scope="{item:tag}"
                        xs12
                        
                >
                    <v-card class="my-5">
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
                </v-flex>
            </v-data-iterator>
        </v-card>
    </div>

</template>

<script>
export default {
    name: 'TagsList',
    props: {
        tags: {
            type: Array,
            required: true
        }
    },
    data() {
        return {
            tag: null,
            dataTags: this.tags,
            headers: [
                { text: "Id", value: "id" },
                { text: "Name", value: "name" },
                { text: "Descripció", value: "description" },
                { text: "Creat", value: "created_at_timestamp" },
                { text: "Modificat", value: "updated_at_timestamp" },
                { text: "Accions", sortable: false, value: "full_search" }
            ]
        }
    }
}
</script>

<style>

</style>
