<?php

require_once "Controller.php";
class SystemController extends Controller {
    public function index(){
        echo "Hello World SystemController Index.";
        exit();
    }
    public function setup(){
        echo "Setup";
        exit();
    }
}