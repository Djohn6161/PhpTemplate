<?php

$routes = [

    '' => ['controller' => 'HomeController', 'method' => 'index'],
    'home/{id}' => ['controller' => 'HomeController', 'method' => 'index2'],
    'about' => ['controller' => 'PageController', 'method' => 'about'],
    'contact' => ['controller' => 'PageController', 'method' => 'contact'],
    // Add more routes as needed
];