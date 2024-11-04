<?php
define("APP_NAME", "phpTemplate");
define("database_name", "phpTemplate");
define("username", "root");
define("password", "");
define("host", "localhost");
define("port", "3306");
try {
    $dsn = "mysql:host=". host .";port=". port .";dbname=". database_name .";charset=utf8";

    $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
    ];
    $pdo = new PDO($dsn, username, password, $options);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit();
}
?>
