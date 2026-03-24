<?php

require_once "Model.php";

class Log extends Model {

    protected $table = "logs";
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
    public function __construct($db_connection = null){
        parent::__construct($db_connection, $this->table);
    }
}