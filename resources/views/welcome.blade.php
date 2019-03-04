@extends('layouts.landing')

@section('title', 'Welcome')

{{-- @section('content') --}}

@section('content')
    <v-app light>
        <v-toolbar dark class="blue-grey darken-4" class="white--text">
            <v-toolbar-title class="text-xs-center hidden-md-and-down">Aplicació de tasques</v-toolbar-title>
            <v-spacer></v-spacer>
            @if (!Auth::user())
                <v-btn dark class="yellow lighten-2 black--text hidden-md-and-down" href="/login">Login</v-btn>
                <v-btn dark class="green lighten-2 black--text" href="/register">Register</v-btn>
            @else
                {{--<v-toolbar-title>--}}
                    {{--<span>{{ Auth::user()->name }}</span>--}}
                {{--</v-toolbar-title>--}}
                <v-btn dark round color="primary" class="elevation-2" placeholder="Home" href="/home">
                    <v-icon>home</v-icon>
                </v-btn>
            @endif
        </v-toolbar>
        <v-content>
            <section>
                <v-parallax src="img/sky.jpeg" height="600" width="auto">
                    <v-layout
                            column
                            align-center
                            justify-center
                    >

                        <img src="svg/logo.svg" alt="Vuetify.js" height="200">
                        <p class="blue--text mb-2" :class='[$vuetify.breakpoint.smAndDown ? "title" : "headline"]'>Aplicació de tasques</p>
                        <div class="black--text mb-3 text-xs-center" :class='[$vuetify.breakpoint.smAndDown ? "subheading" : "headline"]'>Lorem, ipsum dolor sit amet consectetur adipisicing elit by <b class="blues--text">Mimoun Haddou</b></div>
                        <v-btn light large class="blue darken-1 white--text" href="/home">Get Started</v-btn>
                        <v-btn dark color="#6e5494"
                                class="mb-3"
                                target="_blank"
                                rel="noopener"
                                large round v-ripple
                                href="https://github.com/mimoun1997/tasks"
                                rel="noopener"
                            >
                            <picture>
                                <source srcset="/img/Octocat.webp" type="image/webp">
                                <img src="/img/Octocat.png" alt="GitHub de mimoun1997" height="28" class="mr-2">GitHub
                            </picture>
                        </v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-layout
                        column
                        wrap
                        class="my-5"
                        align-center
                >
                    <v-flex xs12 sm4 class="my-3">
                        <div class="text-xs-center">
                            <h2 class="headline">The best way to start developing</h2>
                            <span class="subheading">
                Cras facilisis mi vitae nunc
              </span>
                        </div>
                    </v-flex>
                    <v-flex xs12>
                        <v-container grid-list-xl>
                            <v-layout row wrap align-center>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">color_lens</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Material Design</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">flash_on</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline">Fast development</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                                <v-flex xs12 md4>
                                    <v-card class="elevation-0 transparent">
                                        <v-card-text class="text-xs-center">
                                            <v-icon x-large class="blue--text text--lighten-2">build</v-icon>
                                        </v-card-text>
                                        <v-card-title primary-title class="layout justify-center">
                                            <div class="headline text-xs-center">Completely Open Sourced</div>
                                        </v-card-title>
                                        <v-card-text>
                                            Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                            Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                            Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                        </v-card-text>
                                    </v-card>
                                </v-flex>
                            </v-layout>
                        </v-container>
                    </v-flex>
                </v-layout>
            </section>

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

            <section>
                <v-parallax src="img/team.jpeg" height="400">
                    <v-layout column align-center justify-center>
                        <div class="headline white--text mb-3 text-xs-center">Web development has never been easier</div>
                        <em class="black--text text--darken-4">Kick-start your application today</em>
                        <v-btn light large class="blue darken-1 white--text" href="/home">Get Started</v-btn>
                    </v-layout>
                </v-parallax>
            </section>

            <section>
                <v-container grid-list-xl>
                    <v-layout row wrap justify-center class="my-5">
                        <v-flex xs12 sm4>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Company info</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                    Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas.
                                    Nullam in aliquet odio. Aliquam eu est vitae tellus bibendum tincidunt. Suspendisse potenti.
                                </v-card-text>
                            </v-card>
                        </v-flex>
                        <v-flex xs12 sm4 offset-sm1>
                            <v-card class="elevation-0 transparent">
                                <v-card-title primary-title class="layout justify-center">
                                    <div class="headline">Contact us</div>
                                </v-card-title>
                                <v-card-text>
                                    Cras facilisis mi vitae nunc lobortis pharetra. Nulla volutpat tincidunt ornare.
                                </v-card-text>
                                <v-list class="transparent">
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">phone</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>777-867-5309</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">place</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>Chicago, US</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                    <v-list-tile>
                                        <v-list-tile-action>
                                            <v-icon class="blue--text text--lighten-2">email</v-icon>
                                        </v-list-tile-action>
                                        <v-list-tile-content>
                                            <v-list-tile-title>john@vuetifyjs.com</v-list-tile-title>
                                        </v-list-tile-content>
                                    </v-list-tile>
                                </v-list>
                            </v-card>
                        </v-flex>
                    </v-layout>
                </v-container>
            </section>
        </v-content>
    </v-app>
@endsection
