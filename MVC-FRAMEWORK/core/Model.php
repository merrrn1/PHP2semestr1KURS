<?php
require_once 'config/Database.php';

class Model {
    protected $db;

    public function __construct() {
        $this->db = Database::getInstance();
    }
}
