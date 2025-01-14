<?php
class Model
{
    protected $conn;
    protected $table;
    protected $primaKey = "id";

    public function __construct($conn, $table, $primaKey = 'id')
    {
        $this->conn = $conn;
        $this->table = $table;
        $this->primaKey = $primaKey;
    }
    public function allExcept($conditions = [])
    {
        $query = "SELECT * FROM " . $this->table;
    
        if (!empty($conditions)) {
            $query .= " WHERE ";
            $fields = [];
            foreach ($conditions as $column => $value) {
                $fields[] = "{$column} != :{$column}";
            }
            $query .= implode(" AND ", $fields);
        }
    
        $stmt = $this->conn->prepare($query);
    
        foreach ($conditions as $column => $value) {
            $stmt->bindValue(":{$column}", htmlspecialchars(strip_tags($value)));
        }
    
        $stmt->execute();
    
        // Fetch results as objects of the current class
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);
    
        return $data;
    }
    
    public function all($conditions = [], $limit = "")
    {
        $query = "SELECT * FROM " . $this->table;

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $fields = [];
            foreach ($conditions as $column => $value) {
                $fields[] = "{$column} = :{$column}";
            }
            $query .= implode(" AND ", $fields);
        }
        $query .= $limit;

        $stmt = $this->conn->prepare($query);

        foreach ($conditions as $column => $value) {
            $stmt->bindValue(":{$column}", htmlspecialchars(strip_tags($value)));
        }

        $stmt->execute();

        // Fetch results as objects of the current class
        $data = $stmt->fetchAll(PDO::FETCH_CLASS, static::class);

        return $data;
    }

    public function findById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE " . $this->primaKey . " = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            return $this;
        } else {
            return null;
        }
    }
    public function first($conditions = [], $other = "")
    {
        $query = "SELECT * FROM " . $this->table;

        if (!empty($conditions)) {
            $query .= " WHERE ";
            $fields = [];
            foreach ($conditions as $column => $value) {
                $fields[] = "{$column} = :{$column}";
            }
            $query .= implode(" AND ", $fields);
        }
        $query .= $other . " LIMIT 1";
        $stmt = $this->conn->prepare($query);

        foreach ($conditions as $column => $value) {
            $stmt->bindValue(":{$column}", htmlspecialchars(strip_tags($value)));
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            foreach ($result as $key => $value) {
                if (property_exists($this, $key)) {
                    $this->$key = $value;
                }
            }
            return $this;
        } else {
            return null;
        }
    }

    public function count()
    {
        $query = "SELECT COUNT(*) as 'Total' FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $res = $stmt->fetch(PDO::FETCH_ASSOC);
        // echo $query;
        return $res['Total'];
    }
    public function deleteFile($filename, $uploadDir = __DIR__ . "/../../public/storage/")
    {
        try {
            // Check if filename is empty or null
            if (empty($filename)) {
                return false; // No file to delete, exit gracefully
            }

            // Resolve realpath for uploadDir
            $uploadDir = realpath($uploadDir) . DIRECTORY_SEPARATOR;

            // Sanitize filename to prevent directory traversal
            $filePath = $uploadDir . basename($filename);

            // Ensure file exists and is indeed a file
            if (file_exists($filePath) && is_file($filePath)) {
                if (unlink($filePath)) {
                    return true;
                } else {
                    throw new Exception("Failed to delete file: $filename");
                }
            } else {
                return false; // File does not exist or not a file
            }
        } catch (Exception $e) {
            // Log the error message
            error_log($e->getMessage());
            return false; // Return false to handle the error gracefully
        }
    }
    public function saveFile($tempname, $originalFilename, $uploadDir = __DIR__ . "/../../public/storage/")
    {
        // Extract file extension
        $fileExtension = pathinfo($originalFilename, PATHINFO_EXTENSION);

        // Create a unique filename with the original extension
        $newFilename = uniqid() . '.' . $fileExtension;

        // Ensure the upload directory exists
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Move the new file to the upload directory
        if (move_uploaded_file($tempname, $uploadDir . $newFilename)) {
            // Return the new unique filename
            return $newFilename;
        } else {
            throw new Exception("Failed to upload file.");
        }
    }

    public function save()
    {
        $columns = [];
        $values = [];

        // Loop through all object properties
        foreach ($this as $key => $value) {
            // Exclude private properties like $conn and $table
            if ($key === 'conn' || $key === 'table' || $key === 'primaKey') continue;

            // Only include properties that have been set
            if (isset($this->$key)) {
                $columns[] = $key;
                $values[":$key"] = $value;
            }
        }

        // Check if we are updating or inserting
        if (isset($this->{$this->primaKey})) {  // Use the primary key dynamically
            // Update case
            $setClauses = [];
            foreach ($columns as $column) {
                $setClauses[] = "$column = :$column";
            }
            $query = "UPDATE {$this->table} SET " . implode(", ", $setClauses) . " WHERE {$this->primaKey} = :{$this->primaKey}";
            $stmt = $this->conn->prepare($query);
            $values[":{$this->primaKey}"] = $this->{$this->primaKey}; // Bind the primary key
        } else {
            // Insert case

            $query = "INSERT INTO {$this->table} (" . implode(", ", $columns) . ") VALUES (" . implode(", ", array_keys($values)) . ")";
            $stmt = $this->conn->prepare($query);
        }
        // Bind the values dynamically
        foreach ($values as $placeholder => $value) {
            $stmt->bindValue($placeholder, $value);
        }

        // Execute the query
        if ($stmt->execute()) {
            if (!isset($this->{$this->primaKey})) {
                // Set the new primary key after successful insert
                $this->{$this->primaKey} = $this->conn->lastInsertId();
            }
            return true;
        }
        return false;
    }
    public function delete()
    {
        // Create the SQL delete statement
        $query = "DELETE FROM " . $this->table . " WHERE " . $this->primaKey . " = :primaryKeyValue";

        // Prepare the statement
        $stmt = $this->conn->prepare($query);

        // Bind the value for the primary key
        $stmt->bindParam(':primaryKeyValue', $this->{$this->primaKey});

        // Execute the statement
        if ($stmt->execute()) {
            return true; // Deletion successful
        } else {
            return false; // Deletion failed
        }
    }
    public function search($columnName, $search = null, $condi = "")
    {
        $sql = "SELECT * FROM " . $this->table;

        if ($search) {
            $words = explode(" ", $search);
            $conditions = [];
            $parameters = [];

            foreach ($words as $word) {
                $conditions[] = $columnName . " LIKE ? ";
                $parameters[] = '%' . $word . '%';
            }

            $sql .= " WHERE " . implode(" AND ", $conditions);
            $sql .= $condi;
            $sql .= "LIMIT 10";
            // var_dump($sql);
            // exit();
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($parameters);

            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $results;
        } else {
            return false;
        }
    }
    public function belongsTo($relatedClass, $foreignKey)
    {
        require_once $relatedClass . ".php";
        if (!isset($this->$foreignKey)) {
            throw new Exception("Foreign key '{$foreignKey}' is not set in this model.");
        }
        // new $relatedClass($this->conn);
        $stmt = $this->conn->prepare("SELECT * FROM " . (new $relatedClass($this->conn))->table . " WHERE id = :id");
        $stmt->execute(['id' => $this->$foreignKey]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $relatedClass);
        // var_dump($this->$foreignKey);
        // exit();
        return $stmt->fetch();
    }
    public function belongsToThrough($connectorClass, $connectorKey, $targetClass, $targetForeignKey)
    {
        $connector = $this->belongsTo($connectorClass, $connectorKey);
        if (!$connector) {
            // throw new Exception("No record found in the target model '{$connectorClass}' with id '{$connectorKey}'.");
            return null;
        }
        // return true;
        require_once $targetClass . ".php";
        $stmt = $this->conn->prepare("SELECT * FROM " . (new $targetClass($this->conn))->table . " WHERE id = :id");
        $stmt->execute(['id' => $connector->$targetForeignKey]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $targetClass);
        return $stmt->fetch();
    }
    public function hasManyThrough($connectorClass, $connectorKey, $targetClass, $targetForeignKey)
    {
        // Get the connector table name and instantiate the target class
        require_once $connectorClass . ".php";
        require_once $targetClass . ".php";

        $connectorInstance = new $connectorClass($this->conn);
        $targetInstance = new $targetClass($this->conn);

        // Query to get all matching records from the target table through the connector table
        $stmt = $this->conn->prepare("
        SELECT target.* 
        FROM {$connectorInstance->table} AS connector
        JOIN {$targetInstance->table} AS target 
        ON connector.{$targetForeignKey} = target.id
        WHERE connector.{$connectorForeignKey} = :mainId
    ");

        // Bind the main model's ID to the placeholder
        $stmt->execute(['mainId' => $this->{$this->primaKey}]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, $targetClass);

        // Fetch all matching records
        return $stmt->fetchAll();
    }
    public function hasMany($relatedClass, $foreignKey)
    {
        require_once $relatedClass . ".php";
        if (!isset($this->{$this->primaKey})) {
            throw new Exception("Local key '{$this->primaKey}' is not set in this model.");
        }

        // Query the child model (City) based on the parent model's primary key
        $stmt = $this->conn->prepare("SELECT * FROM " . (new $relatedClass($this->conn))->table . " WHERE {$foreignKey} = :localKey");
        $stmt->execute(["localKey" => $this->{$this->primaKey}]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $relatedClass); // Return all related records as objects
    }
    public function graph($column)
    {
        // SQL query to get counts by month
        $applicants = "SELECT DATE_FORMAT({$column}, '%m') AS month, COUNT(*) AS total 
                       FROM {$this->table}
                       GROUP BY DATE_FORMAT({$column}, '%m') 
                       ORDER BY DATE_FORMAT({$column}, '%m')";
        $queApplicants = $this->conn->prepare($applicants);
        $queApplicants->execute();

        // Array of all months
        $allMonths = [
            '01' => 'January',
            '02' => 'February',
            '03' => 'March',
            '04' => 'April',
            '05' => 'May',
            '06' => 'June',
            '07' => 'July',
            '08' => 'August',
            '09' => 'September',
            '10' => 'October',
            '11' => 'November',
            '12' => 'December'
        ];

        // Initialize arrays
        $appData = array_fill_keys(array_keys($allMonths), 0); // Fill with 0
        $appLabel = $allMonths; // Labels

        // Fetch and populate data
        while ($item = $queApplicants->fetch(PDO::FETCH_ASSOC)) {
            $monthNumber = $item['month'];
            $appData[$monthNumber] = (int) $item['total'];
        }

        return ['data' => array_values($appData), 'label' => array_values($appLabel)];
    }
    public function pgraph($groupBy)
    {
        $query = "SELECT COUNT(*) as total, {$groupBy} as grouping FROM {$this->table} GROUP BY {$groupBy}";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        $data = [];
        $label = [];

        // Fetch results and store them in $data and $label arrays
        while ($item = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = (int) $item['total'];
            $label[] = $item['grouping'] == '' ? 'Unknown' : ucfirst($item['grouping']);
        }

        // If no data found, return default values
        if (empty($data)) {
            $data = [0];
            $label = ['No data'];
        }

        // Return the data and labels
        return ['data' => $data, 'label' => $label];
    }
    // Add other common methods here (e.g., create, update, delete)
}
