<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'ХПК Абитуриент')</title>
    <link rel="shortcut icon" href="/storage/img/favicon.svg">
    <link rel="stylesheet" href="{{ mix('/css/app.css') }}">
    @stack('styles')
    <script src="{{ mix('/js/app.js') }}"></script>
    @stack('scripts')
</head>
<body>
    <header class="laptop">
        @include('layouts.header')
    </header>
    <header class="mobile">
        @include('layouts.header_mobile')
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        @include('layouts.footer')
    </footer>
    <div id="cookie">
        <div class="block_cookie">
            <div class="text">
                <p><span class="accent middle"><b>Мы используем файлы cookie</b></span></p>
                <p><span>Продолжая пользоваться сайтом, вы соглашаетесь с использованием файлов cookie.</span></p>
            </div>
            <a class="button">Хорошо</a>
        </div>
    </div>
    <div id="loader"></div>
    @stack('scripts_after')
</body>
</html>