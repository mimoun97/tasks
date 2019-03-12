<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="Description" content="Aplicaci&oacute; tasques.">
    <meta name="theme-color" content="#2196F3">
    <meta property="og:image:width" content="961">
    <meta property="og:description" content="Aplicaci&oacute; tasques">
    <meta property="og:title" content="App Tasques">
    <meta property="og:url" content="https://tasks.mimoun1997.scool.cat/">
    <meta property="og:image" content="https://tasks.mimoun1997.scool.cat/img/og-image.jpg">
    <meta property="og:image:height" content="503">
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:site" content="@mimoun_97" />
    <meta name="twitter:creator" content="@mimoun_97" />

    <link rel="manifest" href="/manifest.json">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script defer src="{{ mix('/js/manifest.js') }}"></script>
    <script defer src="{{ mix('/js/vendor.js') }}"></script>
    <script defer src="{{ mix('/js/app.js') }}"></script>

    <title>@yield('title','Login to Tasques')</title>
    <style>
        [v-cloak] > * { display:none; }
        [v-cloak]::before {
            content: "";
            display: block;
            width: 48px;
            height: 48px;
            position: absolute;
            top: calc(50% - 24px);
            top: -moz-calc(50% - 24px);
            top: -webkit-calc(50% - 24px);
            top: -o-calc(50% - 24px);
            left: calc(50% - 24px);
            left: -moz-calc(50% - 24px);
            left: -webkit-calc(50% - 24px);
            left: -o-calc(50% - 24px);
            background-image: url('data:image/svg+xml;base64,PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJMYXllcl8xIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIiB4PSIwcHgiIHk9IjBweCIKICAgICB3aWR0aD0iNDhweCIgaGVpZ2h0PSI0OHB4IiB2aWV3Qm94PSIwIDAgMjQgMzAiIHN0eWxlPSJlbmFibGUtYmFja2dyb3VuZDpuZXcgMCAwIDUwIDUwOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+CiAgICA8cmVjdCB4PSIwIiB5PSIxMyIgd2lkdGg9IjQiIGhlaWdodD0iNSIgZmlsbD0iIzM0OTdmOSI+CiAgICAgIDxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9ImhlaWdodCIgYXR0cmlidXRlVHlwZT0iWE1MIgogICAgICAgIHZhbHVlcz0iNTsyMTs1IiAKICAgICAgICBiZWdpbj0iMHMiIGR1cj0iMC42cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIC8+CiAgICAgIDxhbmltYXRlIGF0dHJpYnV0ZU5hbWU9InkiIGF0dHJpYnV0ZVR5cGU9IlhNTCIKICAgICAgICB2YWx1ZXM9IjEzOyA1OyAxMyIKICAgICAgICBiZWdpbj0iMHMiIGR1cj0iMC42cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIC8+CiAgICA8L3JlY3Q+CiAgICA8cmVjdCB4PSIxMCIgeT0iMTMiIHdpZHRoPSI0IiBoZWlnaHQ9IjUiIGZpbGw9IiMxOTc2RDIiPgogICAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJoZWlnaHQiIGF0dHJpYnV0ZVR5cGU9IlhNTCIKICAgICAgICB2YWx1ZXM9IjU7MjE7NSIgCiAgICAgICAgYmVnaW49IjAuMTVzIiBkdXI9IjAuNnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiAvPgogICAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJ5IiBhdHRyaWJ1dGVUeXBlPSJYTUwiCiAgICAgICAgdmFsdWVzPSIxMzsgNTsgMTMiCiAgICAgICAgYmVnaW49IjAuMTVzIiBkdXI9IjAuNnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiAvPgogICAgPC9yZWN0PgogICAgPHJlY3QgeD0iMjAiIHk9IjEzIiB3aWR0aD0iNCIgaGVpZ2h0PSI1IiBmaWxsPSIjMDQ1NGEzIj4KICAgICAgPGFuaW1hdGUgYXR0cmlidXRlTmFtZT0iaGVpZ2h0IiBhdHRyaWJ1dGVUeXBlPSJYTUwiCiAgICAgICAgdmFsdWVzPSI1OzIxOzUiIAogICAgICAgIGJlZ2luPSIwLjNzIiBkdXI9IjAuNnMiIHJlcGVhdENvdW50PSJpbmRlZmluaXRlIiAvPgogICAgICA8YW5pbWF0ZSBhdHRyaWJ1dGVOYW1lPSJ5IiBhdHRyaWJ1dGVUeXBlPSJYTUwiCiAgICAgICAgdmFsdWVzPSIxMzsgNTsgMTMiCiAgICAgICAgYmVnaW49IjAuM3MiIGR1cj0iMC42cyIgcmVwZWF0Q291bnQ9ImluZGVmaW5pdGUiIC8+CiAgICA8L3JlY3Q+CiAgPC9zdmc+');
        }
    </style>
    
</head>
<body>
    <v-app id="app" v-cloak style="background: linear-gradient(to top, #00c6fb 0%, #005bea 100%) fixed; background: -webkit-linear-gradient(to top, #00c6fb 0%, #005bea 100%) fixed">
        @yield('content')
    </v-app>
</body>
</html>
