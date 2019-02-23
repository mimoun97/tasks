<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="user" content="{{ logged_user() }}">
    <meta name="git" content="{{ git() }}">
    <meta name="impersonatedBy" content="{{ Auth::user()->impersonatedBy() }}">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/ico" size="16x16" href="/img/favicon-16x16.png">
    <link rel="icon" type="image/ico" size="32x32" href="/img/favicon-32x32.png">
    <meta property="og:image:height" content="503">
    <meta property="og:image:width" content="961">
    <meta property="og:description" content="Aplicaci&oacute; tasques">
    <meta property="og:title" content="App Tasques">
    <meta property="og:url" content="https://tasks.mimoun1997.scool.cat/">
    <meta property="og:image" content="https://tasks.mimoun1997.scool.cat/img/og-image.jpg">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@mimoun_97" />
    <meta name="twitter:creator" content="@mimoun_97" />
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
        <service-worker></service-worker>
        <navigation v-model="drawer"></navigation>
        <navigation-right v-model="drawerRigth" csrf-token="{{ csrf_token()}}"></navigation-right>
        <v-toolbar class="white primary--text" fixed app clipped-right clipped-left>
            <v-toolbar-side-icon @click.stop="drawer = !drawer" class="primary--text"></v-toolbar-side-icon>
            <v-toolbar-title class="hidden-md-and-down">Aplicació de tasques</v-toolbar-title>
            <v-spacer></v-spacer>

            <span class="mr-5" v-role="'SuperAdmin'"><git-info class="primary--text"></git-info></span>
            <v-spacer></v-spacer>
            <notifications-widget></notifications-widget>

            {{-- <v-toolbar-side-icon @click.stop="drawerRigth = !drawerRigth"></v-toolbar-side-icon> --}}
            <v-avatar @click.stop="drawerRight = !drawerRight" title="{{ Auth::user()->name }} ( {{ Auth::user()->email }} )">
                <img @click.stop="drawerRigth = !drawerRigth" src="https://www.gravatar.com/avatar/{{ md5(Auth::user()->email) }}" alt="avatar" />
            </v-avatar>

        </v-toolbar>
        <v-content>
            @yield('content')
        </v-content>

    </v-app>
</div>
<script src="{{ mix('/js/app.js') }}"></script>
</body>
</html>
