<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="user" content="{{ logged_user() }}">

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="stylesheet" href="/css/tailwind.min.css" type="text/css">
    <title>@yield('title','App Tasques')</title>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        <snackbar></snackbar>
        <v-navigation-drawer
                v-model="drawerRigth"
                fixed
                right
                clipped
                app
        >
            <v-card>
                <v-card-title class="blue darken-3 white--text"><h4>Perfil</h4></v-card-title>
                <v-layout row wrap>
                    <v-flex xs12>
                        <ul>
                            <li>Nom : {{ Auth::user()->name }}</li>
                            <li>Email : {{ Auth::user()->email }}</li>
                            <li>Admin : {{ Auth::user()->admin }}</li>
                            <li>Roles : {{ implode(',',Auth::user()->map()['roles']) }}</li>
                            <li>Permissions : {{ implode(', ',Auth::user()->map()['permissions']) }}</li>
                            {{--<li>Permissions : {{ implode(', ',Auth::user()->map()['permissions']) }}</li>--}}
                        </ul>
                    </v-flex>
                </v-layout>
            </v-card>
            <v-card>
                <v-card-title class="blue darken-3 white--text" primary-title><h4>Opcions administrador</h4></v-card-title>

                    <div row wrap>
                        @canImpersonate

                        <v-flex xs12>
                            <impersonate label="Entrar com..." @selected="impersonate" url="/api/v1/regular_users"></impersonate>

                            {{--<user-select label="Entrar com..." @selected="impersonate" url="/api/v1/regular_users"></user-select>--}}
                        </v-flex>

                        @endCanImpersonate

                        @impersonating

                        <div>
                            <v-avatar title="{{ Auth::user()->impersonatedBy()->name }} ( {{ Auth::user()->impersonatedBy()->email }} )">
                                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->impersonatedBy()->email) }}" alt="avatar">
                            </v-avatar>
                            <p>
                                L'usuari <b>{{ Auth::user()->impersonatedBy()->name }}
                                </b> està suplantant a <b>{{ Auth::user()->name }}</b>
                            </p>
                            <a class="pink--text" href="/impersonate/leave">Abandonar la suplantació</a>
                        </div>

                        @endImpersonating
                    </div>
            </v-card>
        </v-navigation-drawer>
        <v-navigation-drawer
                v-model="drawer"
                fixed
                clipped dark app
                class="indigo darken-1"
        >
            <v-list dense>
                <template v-for="item in items">
                    <v-layout
                            v-if="item.heading"
                            :key="item.heading"
                            row
                            align-center
                    >
                        <v-flex xs6>
                            <v-subheader v-if="item.heading">
                                @{{ item.heading }}
                            </v-subheader>
                        </v-flex>
                        <v-flex xs6 class="text-xs-center">
                            <a href="#!" class="body-2 black--text">EDIT</a>
                        </v-flex>
                    </v-layout>
                    <v-list-group
                            v-else-if="item.children"
                            v-model="item.model"
                            :key="item.text"
                            :prepend-icon="item.model ? item.icon : item['icon-alt']"
                            append-icon=""
                    >
                        <v-list-tile slot="activator" :href="item.url">
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    @{{ item.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                        <v-list-tile
                                v-for="(child, i) in item.children"
                                :key="i"
                                :href="child.url"
                        >
                            <v-list-tile-action v-if="child.icon">
                                <v-icon>@{{ child.icon }}</v-icon>
                            </v-list-tile-action>
                            <v-list-tile-content>
                                <v-list-tile-title>
                                    @{{ child.text }}
                                </v-list-tile-title>
                            </v-list-tile-content>
                        </v-list-tile>
                    </v-list-group>
                    <v-list-tile v-else :key="item.text" :href="item.url">
                        <v-list-tile-action>
                            <v-icon>@{{ item.icon }}</v-icon>
                        </v-list-tile-action>
                        <v-list-tile-content>
                            <v-list-tile-title>
                                @{{ item.text }}
                            </v-list-tile-title>
                        </v-list-tile-content>
                    </v-list-tile>
                </template>
            </v-list>
        </v-navigation-drawer>
        <v-toolbar color="indigo" dark fixed app clipped-right clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer"></v-toolbar-side-icon>
            <v-toolbar-title>Application</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-toolbar-side-icon @click.stop="drawerRigth = !drawerRigth"></v-toolbar-side-icon>
            <v-avatar @click.stop="drawerRight = !drawerRight" title="{{ Auth::user()->name }} ( {{ Auth::user()->email }} )">
                <img src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar" />
            </v-avatar>
            <v-form action="logout" method="POST">
                @csrf
                <v-btn depressed round color="blue-grey darken-4" type="submit" placeholder="Sortir">Logout</v-btn>
            </v-form>
        </v-toolbar>
        <v-content>
            @yield('content')
        </v-content>
        <v-footer color="blue-grey darken-4" app>
            <span class="white--text">Fet per <b>Mimoun Haddou</b> Curs 2018-2019</span>
        </v-footer>
    </v-app>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
</html>
<script>
    import Impersonate from "../../js/components/Impersonate"
    export default {
        components: {Impersonate}
    }
</script>
