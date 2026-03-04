<?php

require_once "Model.php";

class System extends Model
{

    protected $table = "system";
    public $id;
    public $name;
    public $logo;
    public $slug;
    public $status;
    public $updated_at;
    public $created_at;

    public function __construct($db_connection = null)
    {
        parent::__construct($db_connection, $this->table);
    }

    public function createTableIfNotExists()
    {
        // Define the schema for your "System" model specifically
        // You can also make this dynamic by inspecting property types in PHP 8+
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table} (
        id INT AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(255),
        logo VARCHAR(255),
        slug VARCHAR(255),
        status INT(11),
        updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        created_at DATETIME DEFAULT CURRENT_TIMESTAMP
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";

        $this->conn->exec($sql);
    }
}
