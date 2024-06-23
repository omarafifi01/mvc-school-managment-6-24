<?php
class User {
    private $conn;

    public $userId;
    public $username;
    public $password;
    public $userTypeId;
    public $name;
    public $email;
    public $phone;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllUsers() {
        $query = "SELECT * FROM Users";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addUser() {
        $query = "INSERT INTO Users (Username, Password, UserTypeID, Name, Email, Phone) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('ssisss', $this->username, $this->password, $this->userTypeId, $this->name, $this->email, $this->phone);
        $result = $stmt->execute();
        
        if ($result === false) {
            if ($stmt->errno == 1062) { // Duplicate entry
                throw new Exception("Username already exists.");
            } else {
                die("Error executing query: " . $stmt->error);
            }
        }

        return $result;
    }

    public function updateUser() {
        $query = "UPDATE Users SET Username = ?, Password = ?, UserTypeID = ?, Name = ?, Email = ?, Phone = ? WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssisssi', $this->username, $this->password, $this->userTypeId, $this->name, $this->email, $this->phone, $this->userId);
        return $stmt->execute();
    }

    public function deleteUser() {
        $query = "DELETE FROM Users WHERE UserID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->userId);
        return $stmt->execute();
    }
}
?>
