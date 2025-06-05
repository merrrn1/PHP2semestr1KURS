<form name="form_add" method="post" action="">
    <input type="text" name="last_name" placeholder="Фамилия" required>
    <input type="text" name="first_name" placeholder="Имя" required>
    <input type="text" name="middle_name" placeholder="Отчество">
    <select name="gender" required>
        <option value="М">М</option>
        <option value="Ж">Ж</option>
    </select>
    <input type="date" name="birth_date">
    <input type="text" name="phone" placeholder="Телефон">
    <input type="text" name="address" placeholder="Адрес">
    <input type="email" name="email" placeholder="E-mail">
    <textarea name="comment" placeholder="Комментарий"></textarea>
    <input type="submit" name="button" value="Добавить запись">
</form>
<?php
    // если были переданы данные для добавления в БД
    if( isset($_POST['button']) && $_POST['button']== 'Добавить запись')
    {
        $mysqli = mysqli_connect('localhost', 'root', '', 'friends');
        if (mysqli_connect_errno()) {
            return 'Ошибка подключения к БД: ' . mysqli_connect_error();
        }
        mysqli_set_charset($mysqli, 'utf8mb4');

        $last_name = $_POST['last_name'];
        $first_name = $_POST['first_name'];
        $middle_name = $_POST['middle_name'];
        $gender = $_POST['gender'];
        $birth_date = $_POST['birth_date'];
        $phone = $_POST['phone'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $comment = $_POST['comment'];

        // формируем и выполняем SQL-запрос для добавления записи
        $sql_res = mysqli_query($mysqli, 'INSERT INTO friends (last_name, first_name, middle_name, gender, birth_date, phone, address, email, comment) VALUES ("'.
            htmlspecialchars($last_name).'", "'.
            htmlspecialchars($first_name).'", "'.
            htmlspecialchars($middle_name).'", "'.
            htmlspecialchars($gender).'", "'.
            htmlspecialchars($birth_date).'", "'.
            htmlspecialchars($phone).'", "'.
            htmlspecialchars($address).'", "'.
            htmlspecialchars($email).'", "'.
            htmlspecialchars($comment).'")');

       
        if( mysqli_errno($mysqli) )
            echo '<div class="error">Запись не добавлена</div>'; 
        else 
            echo '<div class="ok">Запись добавлена</div>';
    }
?>