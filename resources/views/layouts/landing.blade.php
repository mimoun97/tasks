<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
    <link rel="manifest" href="/manifest.json">
    <link rel="icon" type="image/ico" size="16x16" href="/img/favicon-16x16.png">
    <link rel="icon" type="image/ico" size="32x32" href="/img/favicon-32x32.png">
    <meta property="og:image:height" content="503">
    <meta property="og:image:width" content="961">
    <meta property="og:description" content="Aplicaci&oacute; tasques">
    <meta property="og:title" content="App Tasques">
    <meta property="og:url" content="https://tasks.mimoun1997.scool.cat/">
    <meta property="og:image" content="https://tasks.mimoun1997.scool.cat/img/og-image.jpg">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title','Tasques')</title>
    <style>
        [v-cloak] {
            display: none;
        }
    </style>
</head>
<body>
<div id="app" v-cloak>
    <v-app>
        @yield('content')
    </v-app>
    <share-fab></share-fab>

    <footer-app></footer-app>

</div>
<script src="{{ mix('/js/app.js') }}"></script>
<noscript>
    <p>S'ha <b>d'activar javascript</b> per tal de que la pàgina funcioni <b>correctament.</b></p>
</noscript>
</body>
</html>
