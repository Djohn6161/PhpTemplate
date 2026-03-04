<?php

$routes = [

    '' => ['controller' => 'HomeController', 'method' => 'index'],
    'home' => ['controller' => 'HomeController', 'method' => 'index'],
    'home/{id}' => ['controller' => 'HomeController', 'method' => 'index2'],
    'about' => ['controller' => 'HomeController', 'method' => 'about'],
    'contact' => ['controller' => 'HomeController', 'method' => 'contact'],
    'logout' => ['controller' => 'HomeController', 'method' => 'logout'],
    // Add more routes as needed
];