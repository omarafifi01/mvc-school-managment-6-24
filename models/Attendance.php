<?php
class Attendance {
    private $conn;

    public $attendanceId;
    public $registrationId;
    public $date;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllAttendance() {
        $query = "SELECT * FROM attendance";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addAttendance() {
        $query = "INSERT INTO attendance (RegistrationID, Date, Status) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('iss', $this->registrationId, $this->date, $this->status);
        $result = $stmt->execute();
        
        if ($result === false) {
            if ($stmt->errno == 1452) { // Foreign key constraint fails
                throw new Exception("Invalid registration ID.");
            } else {
                die("Error executing query: " . $stmt->error);
            }
        }

        return $result;
    }

    public function updateAttendance() {
        $query = "UPDATE attendance SET RegistrationID = ?, Date = ?, Status = ? WHERE AttendanceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('issi', $this->registrationId, $this->date, $this->status, $this->attendanceId);
        return $stmt->execute();
    }

    public function deleteAttendance() {
        $query = "DELETE FROM attendance WHERE AttendanceID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->attendanceId);
        return $stmt->execute();
    }
}
?>
