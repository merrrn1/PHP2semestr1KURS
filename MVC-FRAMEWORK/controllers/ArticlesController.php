<?php
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../models/Article.php';
require_once __DIR__ . '/../models/Comment.php';
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

    public function show($id)
    {
        $articleModel = new Article();
        $commentModel = new Comment();

        $article = $articleModel->getById($id);
        $comments = $commentModel->getByArticleId($id);


        $this->view('articles/view', [
            'article' => $article,
            'comments' => $comments
        ]);
    }

    public function edit($id)
    {
        if (!isset($_SESSION['user']['id'])) {
            header('Location: ' . BASE_URL . '/login/login');
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $article = new Article();
        $articleData = $article->getById($id);

        if (!$articleData || $articleData['user_id'] != $userId) {
            Message::set('error', 'Нет доступа');
            header('Location: ' . BASE_URL . '/articles/dashboard');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'] ?? '';
            $content = $_POST['content'] ?? '';

            if ($article->update($id, $userId, $title, $content)) {
                Message::set('success', 'Статья обновлена');
                header('Location: ' . BASE_URL . '/articles/dashboard');
                exit;
            } else {
                Message::set('error', 'Ошибка при обновлении');
            }
        }

        $this->view('articles/edit', ['article' => $articleData]);
    }

    public function addComment($id)
    {
        if (!isset($_SESSION['user']['id'])) {
            Message::set('error', 'Вы не авторизованы');
            header('Location: ' . BASE_URL . '/login/login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $content = trim($_POST['content'] ?? '');
            $userId = $_SESSION['user']['id'];

            if ($content !== '') {
                $commentModel = new Comment();
                $success = $commentModel->create($id, $userId, $content);

                if ($success) {
                    Message::set('success', 'Комментарий добавлен');
                } else {
                    Message::set('error', 'Ошибка при добавлении комментария');
                }
            } else {
                Message::set('error', 'Комментарий не может быть пустым');
            }
        }

        header('Location: ' . BASE_URL . '/articles/show/' . $id);
        exit;
    }
}
