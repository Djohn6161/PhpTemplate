<?php
// app/controllers/BaseController.php
require_once __DIR__ . '/../../config/index.php';

class Controller
{
    protected $pdo;
    protected $basePath;

    public function __construct()
    {
        global $pdo;
        global $basePath;
        $this->pdo = $pdo;
        $this->basePath = "/pms/";
    }
    public function KPIlevels()
    {
        return [
            5 => "Company Level",
            4 => "L1 - Director",
            3 => "L2 - Department Head",
            2 => "L3 - Team Leader",
            1 => "L4 - Staff"
        ];
    }
    public function EmployeeLevel()
    {
        return [
            7 => "Department",
            6 => "Department",
            5 => "Department",
            4 => "Department",
            3 => "Section",
            2 => "Team",
            1 => "Staff"
        ];
    }
    public function query($sql, $params = [])
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($sql);

            // Bind parameters, if any
            foreach ($params as $key => $value) {
                // Use proper binding for named or positional parameters
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;

                // Handle positional placeholders (numerically indexed)
                if (is_int($key)) {
                    $stmt->bindValue($key + 1, $value, $paramType); // Positional binding starts from 1
                } else {
                    $stmt->bindValue($key, $value, $paramType); // Named parameter binding
                }
            }

            // Execute the query
            $stmt->execute();

            // Fetch and return the results
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            // Handle query errors
            die("Query failed: " . $e->getMessage());
        }

        // ** Sample Usages
        //! $sql = "SELECT * FROM employee WHERE status = ?";
        //! $data = $this->query($sql, [1]); // Binding parameter by positional placeholder
        //! print_r($data);

        //* $sql = "SELECT * FROM employee WHERE id = :id";
        // $data = $this->query($sql, [':id' => 2]); // Binding named parameter
        // print_r($data);

        //* $sql = "
        //     SELECT employee.* 
        //     FROM employee 
        //     LEFT JOIN kpi_emp ON employee.id = kpi_emp.employee_id 
        //     WHERE kpi_emp.kpi_id IS NULL OR kpi_emp.kpi_id != :kpi_id
        // ";
        // $data = $this->query($sql, [':kpi_id' => 2]);
        // print_r($data);

    }
    public function deleteQuery($sql, $params = [])
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($sql);

            // Bind parameters, if any
            foreach ($params as $key => $value) {
                // Determine parameter type
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;

                // Handle positional and named placeholders
                if (is_int($key)) {
                    $stmt->bindValue($key + 1, $value, $paramType); // Positional binding
                } else {
                    $stmt->bindValue($key, $value, $paramType); // Named parameter binding
                }
            }

            // Execute the query
            $stmt->execute();

            // Return the number of rows affected
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Handle query errors
            die("Delete operation failed: " . $e->getMessage());
        }
    }
    public function updateQuery($sql, $params = [])
    {
        try {
            // Prepare the SQL statement
            $stmt = $this->pdo->prepare($sql);

            // Bind parameters, if any
            foreach ($params as $key => $value) {
                // Determine parameter type
                $paramType = is_int($value) ? PDO::PARAM_INT : PDO::PARAM_STR;

                // Handle positional and named placeholders
                if (is_int($key)) {
                    $stmt->bindValue($key + 1, $value, $paramType); // Positional binding
                } else {
                    $stmt->bindValue($key, $value, $paramType); // Named parameter binding
                }
            }

            // Execute the query
            $stmt->execute();

            // Return the number of rows affected
            return $stmt->rowCount();
        } catch (PDOException $e) {
            // Handle query errors
            die("Update operation failed: " . $e->getMessage());
        }
    }
    public function getDate()
    {
        $url = "https://worldtimeapi.org/api/timezone/Asia/Manila";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification (use with caution)
        $response = curl_exec($ch);
        if (curl_errno($ch)) {
            return false;
        } else {
            $data = json_decode($response, true);
            if (isset($data['datetime'])) {
                $dateTime = new DateTime($data['datetime']);
                return $dateTime->format('Y-m-d H:i:s');
            } else {
                return "Failed to retrieve datetime.";
            }
        }
        curl_close($ch);
    }
    public function notify()
    {
?>
        <script>
            <?php
            if (session_status() === PHP_SESSION_NONE) {
                session_start();
            }
            if (isset($_SESSION['notification'])):
                $message = $_SESSION['notification']['message'];
                $type = $_SESSION['notification']['type'];
            ?>
                $.notify({
                    message: "<?php echo $message; ?>"
                }, {
                    type: "<?php echo $type; ?>",
                    delay: 2000,
                    allow_dismiss: true,
                    showProgressbar: true,
                    timer: 300
                });
            <?php
                unset($_SESSION['notification']); // Clear the notification after showing it
            endif;
            ?>
        </script>
<?php
    }
}
