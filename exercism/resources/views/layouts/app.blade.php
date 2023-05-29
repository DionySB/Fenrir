<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 
    @yield('styles')
</head>
<body>
    <div id="app">
        @include('partials.nav')
        <main class="py-4 main-content">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    <script src="{{ asset('js/app.js') }}" defer></script>
    @include('partials.footer')
    @yield('scripts')
    
</body>
</html>
