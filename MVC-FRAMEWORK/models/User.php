<?php
require_once __DIR__ . '/Orm.php';
require_once __DIR__ . '/Message.php';

class User extends Orm {

    public function register($data) {
        if (!$this->tableExists('users')) {
            $this->autoMigrate(file_get_contents(__DIR__ . '/../config/schema.sql'));
        }

        // Проверка на уникальность логина и email
        $check = $this->db->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
        $check->execute([$data['username'], $data['email']]);
        if ($check->fetch()) {
            Message::error('Пользователь с таким логином или email уже существует.');
            return false;
        }

        $stmt = $this->db->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
        $pass = password_hash($data['password'], PASSWORD_DEFAULT);
        return $stmt->execute([$data['username'], $pass, $data['email']]);
    }

    public function login($username, $password) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = [
                'id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email']
            ];
            return true;
        }
        return false;
    }

    public function getUser($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public function update($id, $data) {
        $stmt = $this->db->prepare("UPDATE users SET email = ? WHERE id = ?");
        return $stmt->execute([$data['email'], $id]);
    }

    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
