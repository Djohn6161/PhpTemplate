<?php

require_once "Model.php";

class System extends Model {

    protected $table = "system";
    public $id;
    public $name;
    public $logo;
    public $slug;
    public $status;
    public $updated_at;
    public $created_at;

    public function __construct($db_connection = null){
        parent::__construct($db_connection, $this->table);
    }
}