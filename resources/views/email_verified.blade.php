<section>
    <form action="/request" method="post">
        @csrf
        <input type="text" placeholder="Код подтверждения" name="code">
        <input type="submit" value="Продолжить">
    </form>
</section>