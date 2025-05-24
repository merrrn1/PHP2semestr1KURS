<?php

class HomeController
{
    public function index()
    {
        echo '<h1>Добро пожаловать!</h1>';
        echo '<p>Вы успешно запустили фреймворк MVC Muychenko Sergey</p>';
        echo '<p><a href="/framework-mvc/public/login">Перейти к авторизации</a></p>';
    }
}
