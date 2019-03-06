@extends('layouts.landing')

@section('title', 'Screenshots')

@section('content')
    <v-container fluid>
        <v-layout row>
            <v-flex>
                    <section>
                            <v-layout
                                
                                wrap
                                class="my-5"
                                align-center
                            >
                            <v-flex xs12 class="my-3">
                                    <div class="text-xs-center">
                                        <h2 class="headline">Algunes captures de pantalla</h2>
                                        <span class="subheading">
                                            Lorem ipsum, dolor sit amet consectetur adipisicing elit. Quos, modi?
                                        </span>
                                    </div>
                            </v-flex>
                            <v-flex xs12>
                                <carrusel></carrusel>
                            </v-flex>
                                
                            </v-layout>
                        </section>
            </v-flex>
            
        </v-layout>
    </container>
@endsection