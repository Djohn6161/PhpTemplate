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
function assets($path = '') {
    // Get the root directory of the project
    $basePath = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'];

    // Append the "public" folder if your assets are stored there
    return $basePath . '/pms/public/' . ltrim($path, '/');
}
// require __DIR__ . "/../app/Models/Employee.php";

// $Employee = new Employee($pdo);
// $loginInfo = $Employee->findById("1");
$_SESSION['id'] = 1;
$_SESSION['name'] = "Don John Daryl Curativo";
$_SESSION['age'] = "23";
$_SESSION['type'] = 1;
$_SESSION['department'] = 1;
$_SESSION['position'] = "Web Developer";

$basePath = "/";
?>
