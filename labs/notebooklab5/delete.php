<?php
$mysqli = mysqli_connect('localhost', 'root', '', 'friends');
mysqli_set_charset($mysqli, 'utf8mb4');

$delete_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if ($delete_id > 0) {
    $sql = "DELETE FROM friends WHERE id = $delete_id";
    if ($mysqli->query($sql)) {
        echo "<div class='ok'>Запись удалена</div>";
    } else {
        echo "<div class='error'>Ошибка при удалении: " . $mysqli->error . "</div>";
    }
}
else {
    // список всех записей
    echo "<h2>Выберите запись для удаления:</h2><ul>";
    $res = $mysqli->query("SELECT id, last_name, first_name FROM friends ORDER BY last_name");
    while ($row = $res->fetch_assoc()) {
        echo '<li><a href="?p=delete&id=' . $row['id'] . '">' .
            htmlspecialchars($row['last_name'] . ' ' . $row['first_name']) . '</a></li>';
    }
    echo "</ul>";
}
?>