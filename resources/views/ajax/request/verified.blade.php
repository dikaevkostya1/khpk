<section id="request">
    <form method="post">
        @csrf
        <div class="block_input">
            <input type="text" placeholder="Код подтверждения" name="code">
            <input type="submit" value="Продолжить">
        </div>
    </form>
    <a href="/request/verify/change">Изменить почту</a>
    <a href="/request/verify/code">Отправить повторно</a>
    <div id="message">
        
    </div>
</section>
<script src="{{ mix('/js/request.js') }}"></script>