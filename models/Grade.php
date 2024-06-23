<?php
class Grade {
    private $conn;

    public $gradeId;
    public $registrationId;
    public $grade;
    public $examId; // Add this property

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllGrades() {
        $query = "SELECT * FROM Grades";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addGrade() {
        $query = "INSERT INTO Grades (RegistrationID, Grade, ExamID) VALUES (?, ?, ?)"; // Update query
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('isi', $this->registrationId, $this->grade, $this->examId); // Update parameters
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function updateGrade() {
        $query = "UPDATE Grades SET RegistrationID = ?, Grade = ?, ExamID = ? WHERE GradeID = ?"; // Update query
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('isii', $this->registrationId, $this->grade, $this->examId, $this->gradeId); // Update parameters
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function deleteGrade() {
        $query = "DELETE FROM Grades WHERE GradeID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->gradeId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }
}
?>
