<h2>Редактировать статью</h2>
<?= Message::get(); ?>

<form method="post">
    <label>Заголовок</label><br>
    <input type="text" name="title" value="<?= htmlspecialchars($article['title']) ?>"><br><br>

    <label>Содержание</label><br>
    <textarea name="content" rows="10" cols="50"><?= htmlspecialchars($article['content']) ?></textarea><br><br>

    <button type="submit">Сохранить</button>
</form>

<a href="<?= BASE_URL ?>/articles/dashboard">Назад</a>
