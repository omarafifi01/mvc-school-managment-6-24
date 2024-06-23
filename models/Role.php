<?php
class Role {
    private $conn;

    public $userTypeId;
    public $typeName;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllRoles() {
        $query = "SELECT * FROM UserTypes";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addRole() {
        $query = "INSERT INTO UserTypes (TypeName) VALUES (?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('s', $this->typeName);
        $result = $stmt->execute();

        if ($result === false) {
            die("Error executing query: " . $stmt->error);
        }

        return $result;
    }

    public function updateRole() {
        $query = "UPDATE UserTypes SET TypeName = ? WHERE UserTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $this->typeName, $this->userTypeId);
        return $stmt->execute();
    }

    public function deleteRole() {
        $query = "DELETE FROM UserTypes WHERE UserTypeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->userTypeId);
        return $stmt->execute();
    }
}
?>
