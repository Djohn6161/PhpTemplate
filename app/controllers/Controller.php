<?php
// app/controllers/BaseController.php
require_once __DIR__ . '/../../config/index.php';

class Controller {
    protected $pdo;

    public function __construct() {
        global $pdo;
        $this->pdo = $pdo;
    }
}