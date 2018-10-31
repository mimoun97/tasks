<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Laravel')</title>

</head>
<body>



<ul>
    <li><a href="/">Home</a></li>
    <li><a href="/contact">Contact'ns</a> per a aprendre més.</li>
    <li><a href="/about">Sobre</a> nosaltres</li>
    <li><a href="/tasks">Tasques</a></li>
</ul>

@yield('content')

</body>
<script src="{{ mix('/js/app.js') }}"></script>
</html>
