<?php

require_once "Controller.php";
class SystemController extends Controller
{
    public function index()
    {
        echo "Hello World SystemController Index.";
        exit();
    }
    public function setup()
    {
        // echo "Setup";
        require_once __DIR__ . '/../models/System.php';
        require_once __DIR__ . "/../models/User.php";
        $User = new User($this->pdo);
        $System = new System($this->pdo);
        $User->createTableIfNotExists();
        $System->createTableIfNotExists();
        $user = $User->first(['status' => 1]);
        $system = $System->first(['status' => 1]);
        if (!is_null($system) && !is_null($user)) {
            header("Location:" . $this->basePath . "home");
            exit();
        }
        // echo "hi";
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process']) && $_POST['process'] == 1) {
            // $System->name
            // $
            // echo "<pre>";
            // print_r($_POST);
            // print_r($_FILES);
            $System->name = $_POST['name'];
            $System->slug = $_POST['slug'];
            $System->status = 1;
            if (isset($_FILES["logo"]) && !empty($_FILES["logo"]['tmp_name'])) {
                $filenameArray = array();
                $tempFileName = $System->saveFile($_FILES['logo']['tmp_name'], $_FILES['logo']['name']);
                $System->logo = $tempFileName;
            }
            if ($System->save()) {
                $_SESSION['notification'] = [
                    'message' => 'System Setup Successfully Completed',
                    'type' => 'success'
                ];
            } else {
                $_SESSION['notification'] = [
                    'message' => 'System Setup Failed',
                    'type' => 'danger'
                ];
            }
            $this->notify();
            require __DIR__ . "/../components/setup/next.php";
            exit();
        } else if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['process']) && $_POST['process'] == 2) {
            require_once __DIR__ . "/../models/User.php";
            $User = new User($this->pdo);
            // echo "<pre>";
            // print_r($_POST);
            // echo "</pre>";

            // exit();
            $User->first_name = $_POST['first_name'];
            $User->last_name = $_POST['last_name'];
            $User->email = $_POST['email'];
            $username = $this->test_input($_POST['username']);
            $password = $this->test_input($_POST['password']);
            if (empty($username)) {
                $_SESSION['notification'] = [
                    'message' => 'Username is Required',
                    'type' => 'danger'
                ];
                header("Location:" . $_SERVER["HTTP_REFERER"]);
                $this->notify();
                exit();
            } else if (empty($password) || empty($_POST['Cpassword'] || $password != $this->test_input($_POST['Cpassword']))) {
                $_SESSION['notification'] = [
                    'message' => 'password is Required',
                    'type' => 'danger'
                ];
                header("Location:" . $_SERVER["HTTP_REFERER"]);
                $this->notify();
                exit();
            } else {
                // Securely hash the password before storing
                $User->username = $username;
                $User->password = password_hash($password, PASSWORD_DEFAULT);

                // Save user to database (assuming your User model has a save method)
                if ($User->save()) {
                    $_SESSION['notification'] = [
                        'message' => 'Admin Info Setup Successfully Completed',
                        'type' => 'success'
                    ];
                } else {
                    $_SESSION['notification'] = [
                        'message' => 'Admin Info Setup Failed',
                        'type' => 'danger'
                    ];
                }
            }

            header("Location:" . $this->basePath);
            $this->notify();
            exit();
        } else {
            require __DIR__ . "/../../public/views/setup/index.php";
            exit();
        }
    }
    // public function nextSetup()
    // {
    //     echo "hello?";
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //     } else {
    //         require __DIR__ . "/../components/setup/next.php";
    //         exit();
    //     }
    // }
}
