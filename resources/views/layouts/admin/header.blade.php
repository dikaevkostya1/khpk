<div class="header">
    <div class="block">
        <a class="admin">
            @svg('/app/public/img/icons/user.svg', 'icon')
            <span class="middle"><b>{{ $admin->name }}</b></span>
        </a>
        <nav>
            <a href="/admin">Dashboard</a>
            <a href="">Заявки</a>
            <a href="/admin/request">Прием абитуриента</a>
            <a href="">Рейтинг</a>
            <a href="/admin/info">Информация о приеме</a>
            <a href="">Специальности</a>
            <a href="">Обратная связь</a>
            <a href="">Администраторы</a>
            <a href="">Журнал действий</a>
        </nav>
        <a href="/logout/admin" class="button">Выйти</a>
    </div>
</div>