<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Message.php';

class ArticlesController extends Controller
{
    public function dashboard()
    {
        if (!isset($_SESSION['user']) || !isset($_SESSION['user']['id'])) {
            header('Location: ' . BASE_URL . '/login/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $article = new Article();
        $myArticles = $article->getMine($userId);

        $this->view('articles/dashboard', ['articles' => $myArticles]);
    }

    public function create()
    {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: ' . BASE_URL . '/login/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';
            $userId = $_SESSION['user']['id'];

            $article = new Article();
            if ($article->create($userId, $title, $content)) {
                Message::set('success', 'Статья добавлена');
                header('Location: ' . BASE_URL . '/articles/dashboard');
                exit;
            } else {
                Message::set('error', 'Ошибка при добавлении');
            }
        }

        $this->view('articles/create');
    }

    public function delete($id)
    {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: ' . BASE_URL . '/login/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $article = new Article();
        if ($article->delete($id, $userId)) {
            Message::set('success', 'Удалено');
        } else {
            Message::set('error', 'Ошибка удаления');
        }

        header('Location: ' . BASE_URL . '/articles/dashboard');
        exit;
    }
}
