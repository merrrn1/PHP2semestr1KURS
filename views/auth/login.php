<h2>Вход</h2>

<?php echo Message::get(); ?>

<form method="post" action="<?= $baseUrl ?>/login/login">
    <label>Логин: <input type="text" name="username"></label><br>
    <label>Пароль: <input type="password" name="password"></label><br>
    <button type="submit">Войти</button>
</form>

<a href="<?= $baseUrl ?>/login/register">Регистрация</a>
