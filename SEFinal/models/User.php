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

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM Users";
        $result = $this->conn->query($sql);
        return $result;
    }

    public function addUser() {
        $sql = "INSERT INTO Users (Username, Password, UserTypeID, Name, Email, Phone) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisss", $this->username, $this->password, $this->userTypeId, $this->name, $this->email, $this->phone);
        return $stmt->execute();
    }

    public function updateUser() {
        $sql = "UPDATE Users SET Username = ?, Password = ?, UserTypeID = ?, Name = ?, Email = ?, Phone = ? WHERE UserID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("ssisssi", $this->username, $this->password, $this->userTypeId, $this->name, $this->email, $this->phone, $this->userId);
        return $stmt->execute();
    }

    public function deleteUser() {
        $sql = "DELETE FROM Users WHERE UserID = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("i", $this->userId);
        return $stmt->execute();
    }
}
?>
