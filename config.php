<?php

function config($key, $default = null)
{
    $keys = explode('.', $key);
    $file = array_shift($keys);

    $config = require __DIR__ . '/config/' . $file . '.php';

    foreach ($keys as $key) {
        if (isset($config[$key])) {
            $config = $config[$key];
        } else {
            return $default;
        }
    }

    return $config;
}
