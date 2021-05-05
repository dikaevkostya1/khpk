<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ХПК Абитуриент')</title>
    <link rel="shortcut icon" href="/storage/img/favicon.svg">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @stack('styles')
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
</head>
<body>
    <header>
        @include('layouts.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('layouts.footer')
    </footer>
    @stack('scripts_after')
</body>
</html>