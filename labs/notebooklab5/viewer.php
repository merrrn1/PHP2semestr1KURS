<meta charset="UTF-8">
<?php
function getFriendsList($type, $page)
{
    // Подключение к базе данных
    $mysqli = mysqli_connect('localhost', 'root', '', 'friends');
    if (mysqli_connect_errno()) {
        return 'Ошибка подключения к БД: ' . mysqli_connect_error();
    }
    mysqli_set_charset($mysqli, 'utf8mb4');

    // Получаем общее количество записей
    $sql_res = mysqli_query($mysqli, 'SELECT COUNT(*) FROM friends');

    if (!$sql_res) {
        return 'Ошибка SQL-запроса (COUNT): ' . mysqli_error($mysqli);
    }

    $row = mysqli_fetch_row($sql_res);

    if (!$row || !$row[0]) {
        return 'В таблице нет данных';
    }

    $TOTAL = $row[0];
    $PAGES = ceil($TOTAL / 10);

    // защита от выхода за границы
    if ($page >= $PAGES) {
        $page = $PAGES - 1;
    }

    $offset = $page * 10;

    $orderBy = 'id'; // значение по умолчанию

    if ($type === 'fam') {
        $orderBy = 'last_name';
    } elseif ($type === 'byid') {
        $orderBy = 'id';
    }

    $sql = 'SELECT * FROM friends ORDER BY '.$orderBy.' LIMIT '.$offset.', 10';
    $sql_res = mysqli_query($mysqli, $sql);

    if (!$sql_res) {
        return 'Ошибка SQL-запроса (SELECT): ' . mysqli_error($mysqli);
    }

    // Вывод таблицы
    $ret = '<table border="1"><tr>
    <th>Имя</th>
    <th>Фамилия</th>
    <th>Отчество</th>
    <th>Пол</th>
    <th>День Рождения</th>
    <th>Телефон</th>
    <th>Адрес</th>
    <th>Email</th>
    <th>Комментарий</th>
    </tr>';

    // Извлекаем по одной строке из таблицы
    while ($row = mysqli_fetch_assoc($sql_res)) {
        $ret .= '<tr><td>' . htmlspecialchars($row['first_name']) . '</td>
        <td>' . htmlspecialchars($row['last_name']) . '</td>
        <td>' . htmlspecialchars($row['middle_name']) . '</td>
        <td>' . htmlspecialchars($row['gender']) . '</td>
        <td>' . htmlspecialchars($row['birth_date']) . '</td>
        <td>' . htmlspecialchars($row['phone']) . '</td>
        <td>' . htmlspecialchars($row['address']) . '</td>
        <td>' . htmlspecialchars($row['email']) . '</td>
        <td>' . htmlspecialchars($row['comment']) . '</td></tr>';
    }

    $ret .= '</table>';

    // Пагинация
    if ($PAGES > 1) {
        $ret .= '<div id="pages">';
        for ($i = 0; $i < $PAGES; $i++) {
            if ($i != $page)
                $ret .= '<a href="?p=viewer&pg=' . $i . '&sort='.$type.'">' . ($i + 1) . '</a> ';
            else
                $ret .= '<span>' . ($i + 1) . '</span> ';
        }
        $ret .= '</div>';
    }

    return $ret;
}
?>