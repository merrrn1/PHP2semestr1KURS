<h2>Мои статьи</h2>
<?= Message::get(); ?>
<a href="<?= $baseUrl ?>/articles/create">Добавить статью</a>
<ul>
<?php foreach ($articles as $article): ?>
    <li>
        <strong><?= htmlspecialchars($article['title']) ?></strong><br>
        <?= nl2br(htmlspecialchars($article['content'])) ?><br>
        <a href="<?= $baseUrl ?>/articles/delete/<?= $article['id'] ?>">Удалить</a>
    </li>
<?php endforeach; ?>
</ul>
