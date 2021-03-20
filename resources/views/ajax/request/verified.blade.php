<section id="request">
    <form method="post">
        @csrf
        <input type="text" placeholder="Код подтверждения" name="code">
        <input type="submit" value="Продолжить">
    </form>
    <a href="/request/verify/change">Изменить почту</a>
    <a href="/request/verify/code">Отправить повторно</a>
    <div class="message"></div>
</section>
<script src="/js/request.js"></script>