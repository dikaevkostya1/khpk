<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <title>@yield('title', 'Панель администратора')</title>
    <link rel="shortcut icon" href="/storage/img/favicon.svg">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    <link rel="stylesheet" href="{{ mix('/css/admin.css') }}">
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
</head>
<body>
    <div class="header">
        <div class="block">
            @yield('header')
        </div>
    </div>
    <main>
        @yield('content')
    </main>
    <div id="loader"></div>
    @stack('scripts_after')
</body>
</html>