<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet"> 

    <link href="{{ asset('css/partials/footer.css') }}" rel="stylesheet"> 
    <link rel="stylesheet" href="css/partials/navbar.css">
    
    @yield('meta')
</head>
<body>
    <div id="app">
        @include('partials.nav')

        <main class="py-4">
            <div class="container">
                @yield('content')
            </div>
        </main>
    </div>

    @include('partials.footer')

    <script src="{{ asset('js/app.js') }}" defer></script>
    @yield('scripts')
</body>
</html>
