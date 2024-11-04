<?php
require "app/models/Model.php";

// Split the URI by '/' and store it directly in $url
$url = explode('/', $_SERVER['REQUEST_URI']);
$url = array_slice($url, 2);
echo $_SERVER['REQUEST_URI']; // Outputs the full request URI
var_dump($url);