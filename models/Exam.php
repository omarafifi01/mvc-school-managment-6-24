<?php
class Exam {
    private $conn;

    public $examId;
    public $courseId;
    public $examDate;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllExams() {
        $query = "SELECT * FROM Exams";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addExam() {
        $query = "INSERT INTO Exams (CourseID, ExamDate) VALUES (?, ?)";
        $stmt = $this->conn->prepare($query);
        if ($stmt === false) {
            throw new Exception("Error preparing query: " . $this->conn->error);
        }

        $stmt->bind_param('is', $this->courseId, $this->examDate);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function updateExam() {
        $query = "UPDATE Exams SET CourseID = ?, ExamDate = ? WHERE ExamID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('isi', $this->courseId, $this->examDate, $this->examId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }

    public function deleteExam() {
        $query = "DELETE FROM Exams WHERE ExamID = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->examId);
        $result = $stmt->execute();

        if ($result === false) {
            throw new Exception("Error executing query: " . $stmt->error, $stmt->errno);
        }

        return $result;
    }
}
?>
