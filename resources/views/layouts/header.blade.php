<div class="menu">
    @section('header')
        <div id="logo">
            @section('logo')
            <a href="/" class="logo_block">
                <div class="logo">
                    @svg('/app/public/img/icons/logo/logo.svg', 'img')
                    <span class="text">Хакасский<br>политехнический<br>колледж</span>
                </div>
                <div class="border"></div>
            </a>
            @show
        </div>
        @yield('content_header')
        <nav>
            @yield('nav')
        </nav>
    @show
</div>
