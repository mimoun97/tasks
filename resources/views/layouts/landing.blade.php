<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Aplicaci&oacute; tasques.">
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
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            margin: 0 auto;
            content: "";
            display: flex;
            width: 72px;
            height: 72px;
            position: absolute;
            top: 50%;
            left: 50%;
            background-image: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIKICAgICB3aWR0aD0iNzJweCIgaGVpZ2h0PSI3MnB4IiB2aWV3Qm94PSIwIDAgMjQgMzAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUwIDUwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CiAgICA8cmVjdCB4PSIwIiB5PSIxMyIgd2lkdGg9IjQiIGhlaWdodD0iNSIgZmlsbD0iIzM0OTdmOSI+CiAgICAgIDxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImhlaWdodCIgYXR0cmlidXRlVHlwZT0iWE1MIgogICAgICAgIHZhbHVlcz0iNTsyMTs1IiAKICAgICAgICBiZWdpbj0iMHMiIGR1cj0iMC42cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIC8+CiAgICAgIDxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9InkiIGF0dHJpYnV0ZVR5cGU9IlhNTCIKICAgICAgICB2YWx1ZXM9IjEzOyA1OyAxMyIKICAgICAgICBiZWdpbj0iMHMiIGR1cj0iMC42cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIC8+CiAgICA8L3JlY3Q+CiAgICA8cmVjdCB4PSIxMCIgeT0iMTMiIHdpZHRoPSI0IiBoZWlnaHQ9IjUiIGZpbGw9IiMxOTc2RDIiPgogICAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJoZWlnaHQiIGF0dHJpYnV0ZVR5cGU9IlhNTCIKICAgICAgICB2YWx1ZXM9IjU7MjE7NSIgCiAgICAgICAgYmVnaW49IjAuMTVzIiBkdXI9IjAuNnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiAvPgogICAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJ5IiBhdHRyaWJ1dGVUeXBlPSJYTUwiCiAgICAgICAgdmFsdWVzPSIxMzsgNTsgMTMiCiAgICAgICAgYmVnaW49IjAuMTVzIiBkdXI9IjAuNnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiAvPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0iMjAiIHk9IjEzIiB3aWR0aD0iNCIgaGVpZ2h0PSI1IiBmaWxsPSIjMDQ1NGEzIj4KICAgICAgPGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iaGVpZ2h0IiBhdHRyaWJ1dGVUeXBlPSJYTUwiCiAgICAgICAgdmFsdWVzPSI1OzIxOzUiIAogICAgICAgIGJlZ2luPSIwLjNzIiBkdXI9IjAuNnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiAvPgogICAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJ5IiBhdHRyaWJ1dGVUeXBlPSJYTUwiCiAgICAgICAgdmFsdWVzPSIxMzsgNTsgMTMiCiAgICAgICAgYmVnaW49IjAuM3MiIGR1cj0iMC42cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIC8+CiAgICA8L3JlY3Q+CiAgPC9zdmc+');
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
