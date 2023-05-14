<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Minha aplicação Laravel</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('styles')
</head>
<body>
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>