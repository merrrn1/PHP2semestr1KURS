<h2>Добавить статью</h2>
<?= Message::get(); ?>
<form method="post" action="<?= $baseUrl ?>/articles/create">
    <label>Заголовок: <input type="text" name="title"></label><br>
    <label>Текст:<br> <textarea name="content" rows="5"></textarea></label><br>
    <button type="submit">Сохранить</button>
</form>
