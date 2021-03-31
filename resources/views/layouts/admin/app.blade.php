<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Панель администратора')</title>
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
</head>
<body>
    <header>
        @include('layouts.admin.header')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('layouts.admin.footer')
    </footer>
    @stack('scripts_after')
</body>
</html>