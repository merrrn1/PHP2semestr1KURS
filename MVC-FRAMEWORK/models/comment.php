<?php

require_once 'Orm.php';

class Comment extends Orm
{
    private $table = 'comments';

    public function __construct()
    {
        parent::__construct();

        if (!$this->tableExists($this->table)) {
            $this->db->exec("CREATE TABLE IF NOT EXISTS comments (
                id INT AUTO_INCREMENT PRIMARY KEY,
                article_id INT NOT NULL,
                user_id INT NOT NULL,
                content TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
        }
    }

    public function create($articleId, $userId, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (article_id, user_id, content) VALUES (?, ?, ?)");
        return $stmt->execute([$articleId, $userId, $content]);
    }

    public function getByArticleId($articleId)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE article_id = ? ORDER BY created_at DESC");
        $stmt->execute([$articleId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
