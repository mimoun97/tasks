<template>
<v-container
            fill-height
            fluid
            grid-list-xl>
        <v-layout
                justify-center
                wrap
        >
            <v-flex
                    xs12
                    md8
            >
                <v-card>
                    <v-toolbar color="primary">
                        <v-toolbar-title class="white--text">Settings</v-toolbar-title>
                        <v-spacer></v-spacer>
                    </v-toolbar>
                    <v-card-media>
                        <v-chip color="primary" class="white--text">Select color</v-chip>
                        <input type="color">
                    </v-card-media>
                </v-card>
                <v-card>
                    <v-img
                    src="https://cdn.vuetifyjs.com/images/cards/desert.jpg"
                    aspect-ratio="2.75"
                    ></v-img>

                    <v-card-title primary-title>
                    <div>
                        <h3 class="headline mb-0">
                        Kangaroo Valley Safari
                        </h3>
                        <div>Located two hours south of Sydney in the <br>Southern Highlands of New South Wales, ...</div>
                    </div>
                    </v-card-title>

                    <v-card-actions>
                    <v-btn
                        flat
                        color="grey darken-4"
                    >
                        Share
                    </v-btn>
                    <v-btn
                        flat
                        color="secondary"
                    >
                        Explore
                    </v-btn>
                    </v-card-actions>
                </v-card>
            </v-flex>
            <v-flex>
                <v-layout align-center justify-center column fill-height>
                    <div>
                        <v-btn color="primary">
                            Success
                        </v-btn>
                        <v-btn color="success">
                            Success
                        </v-btn>
                        <v-btn color="error">
                            Error
                        </v-btn>
                        <v-btn color="warning">
                            Warning
                        </v-btn>
                        <v-btn color="info">
                            Info
                        </v-btn>
                    </div>
                    <div>
                        <v-btn color="primary darken-3">
                        Success
                    </v-btn>
                    <v-btn color="success darken-1">
                        Success
                    </v-btn>
                    <v-btn color="error darken-1">
                        Error
                    </v-btn>
                    <v-btn color="warning darken-1">
                        Warning
                    </v-btn>
                    <v-btn color="info darken-1">
                        Info
                    </v-btn>
                </div>
                </v-layout>
                
            </v-flex>
        </v-layout>
    </v-container>
</template>
<script>
export default {
    
}
</script>

