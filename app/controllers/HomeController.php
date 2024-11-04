<?php
class HomeController {
    public function index(){
        // echo $id . __DIR__;
        require __DIR__ . "/../../public/views/index.php";
    }
    public function index2($id){
        // echo $id . __DIR__;
        // echo __DIR__ . "/../public/views/index.php";

        require __DIR__  . '/../../public/views/home.php';
    }
}