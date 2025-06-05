<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Музыченко Сергей</title>
</head>
<body>
    <header>
        <img src="../images/mospolytech_logo.png" alt="Лого">
        <h1>Feedback Form</h1>
    </header>
    <main>
        <?php 
            $result = get_headers("https://httpbin.org/post");
            echo "<p>";
                print_r($result);
            echo "</p>";
        ?>
    </main>
    <footer>
        <p>Собрать сайт из двух страниц.
            <br>1 страница: Сверстать форму обратной связи. Отправку формы осуществить на URL: https://httpbin.org/post. Добавить кнопку для перехода на 2 страницу.
            <br>2 страница: Вывести на страницу результат работы функции get_headers. Загрузить код в удаленный репозиторий. Залить на хостинг.
        </p>
    </footer>
</body>
</html>