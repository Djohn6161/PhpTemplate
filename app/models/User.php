<?php

require_once "Model.php";

class User extends Model
{
    protected $table = "users";

    public $id;
    public $username;
    public $email;
    public $password;
    public $status;
    public $sort;
    public $first_name;
    public $last_name;
    public $updated_at;
    public $created_at;

    public function __construct($db_connection = null)
    {
        parent::__construct($db_connection, $this->table);
    }
    public function createTableIfNotExists()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        password TEXT NOT NULL,
        status TINYINT(1) DEFAULT 1,
        sort INT(11) DEFAULT 0,
        first_name VARCHAR(255),
        last_name VARCHAR(255),
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;";

        $this->conn->exec($sql);
    }
}
