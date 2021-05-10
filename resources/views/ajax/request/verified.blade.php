@section('header')
    @parent
    @section('nav')
    <a href="/logout/enrolle" class="button">Выйти</a>
    @endsection
@endsection
<section id="request">
    <form method="post" class="block_column">
        @csrf
        <div class="title_block">
            <div class="title">
                <div class="stage"><b>{{ $request_stage }} этап</b></div>
                <h1 class="gradient">Подтверждение регистрации</h1>
            </div>
            <input type="submit" value="Продолжить" disabled>
        </div>
        <div class="flex-center">
            <div class="form_block code_block">
                <span class="title">Введите код</span>
                <div class="block_input">
                    <div class="code">
                        <input type="text" name="code1" maxlength="1" class="input">
                        <input type="text" name="code2" maxlength="1" class="input">
                        <input type="text" name="code3" maxlength="1" class="input">
                        <input type="text" name="code4" maxlength="1" class="input">
                    </div>
                </div>
                <span class="text">На вашу почту отправлено письмо с кодом для подтверждения регистрации</span>
                <a href="/request/verify/change" class="button_small">Изменить почту</a>
                <div class="timer_block">Отправить через <span class="time">60</span></div>
                <a onclick="timer_click('/request/verify/code')" class="button_small timer_button">Отправить повторно</a>
            </div>
        </div>
    </form>
</section>
<div id="loader"></div>
@include('layouts.message', [
    'title' => 'Ошибка формы'
])
<script src="{{ mix('/js/request.js') }}"></script>