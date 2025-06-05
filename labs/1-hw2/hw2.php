<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/style.css">
    <title>Музыченко Сергей</title>
    <style>
        form {
            display: flex; 
            flex-direction: 
            column; gap: 15px; 
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <header>
        <img src="../images/mospolytech_logo.png" alt="Лого">
        <h1>Feedback Form</h1>
    </header>
    <main>
        <section>
            <h2>Форма</h2>
            <form action="https://httpbin.org/post" method="post">
                <label>Имя: <input type="text" id="name" name="name"></label>
                <label>Email: <input type="email" id="email" name="email"></label>
                <fieldset>
                    <legend>Причина обращения:</legend>
                    <label>
                        <input type="radio" name="feedbackType" value="complain">
                        Жалоба
                    </label>
                    <label>
                        <input type="radio" name="feedbackType" value="suggestion">
                        Предложение
                    </label>
                    <label>
                        <input type="radio" name="feedbackType" value="gratitude">
                        Благодарность
                    </label>
                </fieldset>
                <div>
                    <label for="appeal_text">Текст обращения:</label>
                    <textarea id="appeal_text" name="appeal_text" rows="5" cols="100"
                        placeholder="Напишите сюда текст."></textarea>
                </div>
                <fieldset>
                    <legend>Вариант ответа:</legend>
                    <label>
                        <input type="checkbox" name="response_type" value="sms">
                        СМС
                    </label>
                    <label>
                        <input type="checkbox" name="response_type" value="email">
                        Email
                    </label>
                </fieldset>
                <div>
                    <button type="submit">Отправить</button>
                    <a href="hw2_response.php">Перейти на 2 страницу</a>
                </div>
            </form>
        </section>
    </main>
    <footer>
        <p>Собрать сайт из двух страниц.
            <br>1 страница: Сверстать форму обратной связи. Отправку формы осуществить на URL: https://httpbin.org/post. Добавить кнопку для перехода на 2 страницу.
            <br>2 страница: Вывести на страницу результат работы функции get_headers. Загрузить код в удаленный репозиторий. Залить на хостинг.
        </p>
    </footer>
</body>

</html>