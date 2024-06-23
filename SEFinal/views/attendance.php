<?php
class Attendance {
    private $conn;

    public $AttendanceID;
    public $RegistrationID;
    public $Date;
    public $Status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllAttendances() {
        $query = "SELECT * FROM Attendance";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addAttendance() {
        $query = "INSERT INTO Attendance (RegistrationID, Date, Status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('iss', $this->RegistrationID, $this->Date, $this->Status);
        return $stmt->execute();
    }

    public function updateAttendance() {
        $query = "UPDATE Attendance SET RegistrationID = ?, Date = ?, Status = ? WHERE AttendanceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('issi', $this->RegistrationID, $this->Date, $this->Status, $this->AttendanceID);
        return $stmt->execute();
    }

    public function deleteAttendance() {
        $query = "DELETE FROM Attendance WHERE AttendanceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->AttendanceID);
        return $stmt->execute();
    }
}
?>
