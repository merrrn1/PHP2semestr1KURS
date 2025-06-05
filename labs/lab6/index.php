<?php

// ЗАДАНИЕ 1
// По заходу на страницу запишите в сессию текст 'test'. 
// Затем обновите страницу и выведите содержимое сессии на экран.
session_start();
$_SESSION['test'] = 'test';
echo $_SESSION['test'];

echo '<BR>';
//
//Пусть у вас есть две страницы сайта. 
// Запишите на первой странице что-нибудь в сессию, 
// а затем выведите это при заходе на другую страницу.
$_SESSION['task2'] = 'task2';
echo '<a href=demo.php> next page </a>';

echo '<BR>';

// ЗАДАНИЕ 3
// Сделайте счетчик обновления страницы пользователем. Данные храните в сессии. 
// Скрипт должен выводить на экран количество обновлений. 
// При первом заходе на страницу он должен вывести сообщение о том, что вы еще не обновляли страницу.

if (!isset($_SESSION['task3_counter'])) {
    $_SESSION['task3_counter'] = 1;
} else {
    $_SESSION['task3_ counter'] = $_SESSION['task3_counter'] + 1;
}
echo 'Вы обновили эту страницу '.$_SESSION['task3_counter'].' раз!';

echo '<BR>';

// ЗАДАНИЕ 4
// Сделайте две страницы: index.php и test.php. 
// При заходе на index.php спросите с помощью формы страну пользователя, 
// запишите ее в сессию (форма при этом должна отправится на эту же страницу). 
// Пусть затем пользователь зайдет на страницу test.php - выведите там страну пользователя.

if (isset($_POST['send'])) {
    $_SESSION['country'] = $_POST['country'];
}
?>

<form method="post" action="index.php">
    <input name="country" value="Russia">
    <input type="submit" name="send" value="Submit">
</form>

<?php
if (isset($_SESSION['country'])) {
    echo '<a href="demo.php">See country</a>';
}

echo '<BR>';

// ЗАДАНИЕ 5
// Запишите в сессию время захода пользователя на сайт. 
// При обновлении страницы выводите сколько секунд назад пользователь зашел на сайт.
if (!isset($_SESSION['time'])) {
    $_SESSION['time'] = time();
}
else {
    echo time() - $_SESSION['time'];
}

?>