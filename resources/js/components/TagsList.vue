<template>
    <div>
        <v-toolbar color="primary">
            <v-menu>
                <v-btn slot="activator" icon dark>
                    <v-icon>more_vert</v-icon>
                </v-btn>
                <v-list>
                    <v-list-tile>
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
                <template slot="items" slot-scope="{item: tag}">
                    <tr>
                        <td v-text="tag.id"></td>
                        <td><v-chip dark :color="tag.color">{{tag.name}}</v-chip></td>
                        <td v-text="tag.description"></td>
                        <td v-text="tag.created_at_human"></td>
                        <td v-text="tag.updated_at_human"></td>
                        
                        <!-- <td><v-avatar  size="28" :color="tag.color"></v-avatar></td> -->
                        <td>
                            <!-- <v-btn icon color="primary" flat title="Mostrar la etiqueta"
                                   @click="show(tag)">
                                <v-icon>visibility</v-icon>
                            </v-btn>
                            <v-btn icon color="success" flat title="Canviar la etiqueta"
                                   @click="showUpdate(tag)">
                                <v-icon>edit</v-icon>
                            </v-btn>
                            <v-btn v-can="tasks.destroy" icon color="error" flat title="Eliminar la etiqueta"
                                   @click="showDestroy(tag)">
                                <v-icon>delete</v-icon>
                            </v-btn> -->
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
                    <v-card slot="item"
                        slot-scope="{item:tag}"
                        xs12 class="my-1 mx-2">
                        <v-card-title class="title grey--text text--darken-1 my-2" ><v-chip dark :color="tag.color" class="title">{{tag.name}}</v-chip></v-card-title>
                        <v-card-text class="content grey--text text--darken-4 my-2" v-text="tag.description"></v-card-text>
                        <v-card-actions class="hidden-xs">
                            <v-layout column  class="ml-3" align-start>
                                <v-list-tile-content class="grey--text text--darken-4">{{ tag.user_name }}</v-list-tile-content>
                                <v-list-tile-content class="grey--text text--darken-4" >Creat {{ tag.created_at_human }}</v-list-tile-content>
                                <v-list-tile-content class="grey--text text--darken-1" >Ultima actualització {{tag.updated_at_human}}</v-list-tile-content>
                            </v-layout>
                            <v-layout column align-end justify-space-between>
                                    <v-flex mb-2>
                                        <v-btn icon color="primary" flat>
                                            <v-icon >visibility</v-icon>
                                        </v-btn>
                                    </v-flex>
                                    <v-flex mb-2>
                                        <v-btn icon color="error" flat>
                                            <v-icon >delete</v-icon>
                                        </v-btn>
                                    </v-flex>
                                    <v-flex mb-2>
                                        <v-btn icon color="success" flat>
                                            <v-icon color="blue">edit</v-icon>
                                        </v-btn>
                                    </v-flex> 
                            </v-layout>
                        </v-card-actions>
                    </v-card>
            
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
            loading: false,
            dataTasks: this.tasks,
            dataUsers: this.users,
            search: "",
            pagination: {
                rowsPerPage: 25
            },
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
