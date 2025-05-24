<?php

require_once 'Orm.php';

class Article extends Orm
{
    private $table = 'articles';

    public function __construct()
    {
        parent::__construct();
        if (!$this->tableExists($this->table)) {
            $this->db->exec("CREATE TABLE IF NOT EXISTS articles (
                id INT AUTO_INCREMENT PRIMARY KEY,
                user_id INT NOT NULL,
                title VARCHAR(255) NOT NULL,
                content TEXT NOT NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
        }
    }

    public function create($userId, $title, $content)
    {
        $stmt = $this->db->prepare("INSERT INTO {$this->table} (user_id, title, content) VALUES (?, ?, ?)");
        return $stmt->execute([$userId, $title, $content]);
    }

    public function delete($id, $userId)
    {
        $stmt = $this->db->prepare("DELETE FROM {$this->table} WHERE id = ? AND user_id = ?");
        return $stmt->execute([$id, $userId]);
    }

    public function getById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function getAll()
    {
        $stmt = $this->db->query("SELECT * FROM {$this->table} ORDER BY created_at DESC");
        return $stmt->fetchAll();
    }

    public function getMine($userId)
    {
        $stmt = $this->db->prepare("SELECT * FROM {$this->table} WHERE user_id = ? ORDER BY created_at DESC");
        $stmt->execute([$userId]);
        return $stmt->fetchAll();
    }

    public function update($id, $userId, $title, $content)
    {
        $stmt = $this->db->prepare("UPDATE {$this->table} SET title = ?, content = ? WHERE id = ? AND user_id = ?");
        return $stmt->execute([$title, $content, $id, $userId]);
    }
}
