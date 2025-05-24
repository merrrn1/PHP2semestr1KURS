<h2>Регистрация</h2>

<?= Message::get(); ?>

<form method="post" action="<?= $baseUrl ?>/login/register">
    <label>Имя пользователя: <input type="text" name="username"></label><br>
    <label>Email: <input type="email" name="email"></label><br>
    <label>Пароль: <input type="password" name="password"></label><br>
    <button type="submit">Зарегистрироваться</button>
</form>

<p><a href="<?= $baseUrl ?>/login/login">Войти</a></p>
