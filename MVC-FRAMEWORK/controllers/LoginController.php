<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/Message.php';

class LoginController extends Controller {

    public function index() {
        $this->login(); // перенаправление по умолчанию
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            if ($user->login($_POST['username'], $_POST['password'])) {
                Message::set('success', 'Вы вошли в систему');
                header('Location: ' . BASE_URL . '/articles/dashboard');
                exit;
            } else {
                Message::set('error', 'Неверный логин или пароль');
                $this->view('auth/login');
            }
        } else {
            $this->view('auth/login');
        }
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $user = new User();
            if ($user->register($_POST)) {
                Message::set('success', 'Регистрация успешна');
                header('Location: ' . BASE_URL . '/login/login');
                exit;
            } else {
                Message::set('error', 'Ошибка регистрации');
                $this->view('auth/register');
            }
        } else {
            $this->view('auth/register');
        }
    }

    public function logout() {
        session_destroy();
        header('Location: /auth/login');
        exit;
    }
}
