<?php
class Registration {
    private $conn;

    public $registrationId;
    public $studentId;
    public $courseId;
    public $registrationDate;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllRegistrations() {
        $query = "SELECT * FROM Registrations";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addRegistration() {
        $query = "INSERT INTO Registrations (StudentID, CourseID, RegistrationDate) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('iis', $this->studentId, $this->courseId, $this->registrationDate);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function updateRegistration() {
        $query = "UPDATE Registrations SET StudentID = ?, CourseID = ?, RegistrationDate = ? WHERE RegistrationID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iisi', $this->studentId, $this->courseId, $this->registrationDate, $this->registrationId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function deleteRegistration() {
        $query = "DELETE FROM Registrations WHERE RegistrationID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->registrationId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }
}
?>
