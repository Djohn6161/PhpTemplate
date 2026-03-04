<?php 
require_once "Model.php";

class Notification extends Model {
    protected $table = "notifications";
    public $id;
    public $user_id;
    public $type;
    public $message;
    public $is_read;
    public $url;
    public $created_at;
    
    public function __construct($db_connection = null)
    {
        parent::__construct($db_connection, $this->table);
    }
}