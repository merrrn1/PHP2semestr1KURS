<h2><?= htmlspecialchars($article['title']) ?></h2>
<p><?= nl2br(htmlspecialchars($article['content'])) ?></p>
<p><small>Дата: <?= $article['created_at'] ?></small></p>

<hr>
<h3>Комментарии</h3>

<?php if (!empty($comments)): ?>
    <?php foreach ($comments as $comment): ?>
        <div style="border:1px solid #ccc; padding: 10px; margin-bottom: 10px;">
            <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
            <small>Пользователь: <?= $comment['user_id'] ?> | <?= $comment['created_at'] ?></small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <p>Комментариев пока нет.</p>
<?php endif; ?>

<hr>

<?php if (isset($_SESSION['user'])): ?>
    <h4>Добавить комментарий</h4>
    <form method="POST" action="<?= BASE_URL ?>/articles/addComment/<?= $article['id'] ?>">
        <textarea name="content" rows="4" cols="50" required></textarea><br>
        <button type="submit">Отправить</button>
    </form>
<?php else: ?>
    <p><a href="<?= BASE_URL ?>/login/login">Войдите</a>, чтобы оставить комментарий.</p>
<?php endif; ?>
