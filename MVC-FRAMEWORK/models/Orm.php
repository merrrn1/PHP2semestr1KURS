<?php
require_once __DIR__ . '/../config/Database.php';


class Orm {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    public function tableExists($table) {
        $stmt = $this->db->query("SHOW TABLES LIKE '{$table}'");
        return $stmt->rowCount() > 0;
    }

    public function autoMigrate($sql) {
        $this->db->exec($sql);
    }
}
