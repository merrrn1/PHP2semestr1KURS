<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'friends');
mysqli_set_charset($mysqli, 'utf8mb4');

$edit_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($edit_id > 0) {
    // данные выбранной записи
    $res = $mysqli->query("SELECT * FROM friends WHERE id = $edit_id");
    if ($res && $res->num_rows > 0) {
        $edit_data = $res->fetch_assoc();
        ?>
        <h2>Редактирование записи</h2>
        <form method="post" action="">
            <input type="text" name="last_name" value="<?= htmlspecialchars($edit_data['last_name']) ?>" placeholder="Фамилия" required><br>
            <input type="text" name="first_name" value="<?= htmlspecialchars($edit_data['first_name']) ?>" placeholder="Имя" required><br>
            <input type="text" name="middle_name" value="<?= htmlspecialchars($edit_data['middle_name']) ?>" placeholder="Отчество"><br>
            <select name="gender" required>
                <option value="М" <?= ($edit_data['gender'] == 'М') ? 'selected' : '' ?>>М</option>
                <option value="Ж" <?= ($edit_data['gender'] == 'Ж') ? 'selected' : '' ?>>Ж</option>
            </select><br>
            <input type="date" name="birth_date" value="<?= $edit_data['birth_date'] ?>"><br>
            <input type="text" name="phone" value="<?= htmlspecialchars($edit_data['phone']) ?>" placeholder="Телефон"><br>
            <input type="text" name="address" value="<?= htmlspecialchars($edit_data['address']) ?>" placeholder="Адрес"><br>
            <input type="email" name="email" value="<?= htmlspecialchars($edit_data['email']) ?>" placeholder="E-mail"><br>
            <textarea name="comment" placeholder="Комментарий"><?= htmlspecialchars($edit_data['comment']) ?></textarea><br>
            <input type="submit" name="save" value="Сохранить">
        </form>
        <?php

        // отправлена форма на сохранение
        if (isset($_POST['save'])) {
            $sql = "UPDATE friends SET 
                last_name = '" . htmlspecialchars($_POST['last_name']) . "',
                first_name = '" . htmlspecialchars($_POST['first_name']) . "',
                middle_name = '" . htmlspecialchars($_POST['middle_name']) . "',
                gender = '" . $_POST['gender'] . "',
                birth_date = '" . $_POST['birth_date'] . "',
                phone = '" . htmlspecialchars($_POST['phone']) . "',
                address = '" . htmlspecialchars($_POST['address']) . "',
                email = '" . htmlspecialchars($_POST['email']) . "',
                comment = '" . htmlspecialchars($_POST['comment']) . "'
                WHERE id = $edit_id";

            if ($mysqli->query($sql)) {
                echo "<div class='ok'>Запись обновлена</div>";
            } else {
                echo "<div class='error'>Ошибка при обновлении: " . $mysqli->error . "</div>";
            }
        }

    } else {
        echo "<div class='error'>Запись не найдена</div>";
    }
} else {
    // список всех записей
    echo "<h2>Выберите запись для редактирования:</h2><ul>";
    $res = $mysqli->query("SELECT id, last_name, first_name FROM friends ORDER BY last_name");
    while ($row = $res->fetch_assoc()) {
        echo '<li><a href="?p=edit&id=' . $row['id'] . '">' .
            htmlspecialchars($row['last_name'] . ' ' . $row['first_name']) . '</a></li>';
    }
    echo "</ul>";
}
?>