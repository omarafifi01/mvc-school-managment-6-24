<?php
class Course {
    private $conn;

    public $courseId;
    public $courseName;
    public $description;
    public $teacherId;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllCourses() {
        $query = "SELECT * FROM courses";
        $result = $this->conn->query($query);

        if (!$result) {
            die("Query failed: " . $this->conn->error);
        }

        return $result;
    }

    public function addCourse() {
        $query = "INSERT INTO courses (courseName, description, teacherId) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssi', $this->courseName, $this->description, $this->teacherId);
        return $stmt->execute();
    }

    public function updateCourse() {
        $query = "UPDATE courses SET courseName = ?, description = ?, teacherId = ? WHERE courseId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('ssii', $this->courseName, $this->description, $this->teacherId, $this->courseId);
        return $stmt->execute();
    }

    public function deleteCourse() {
        $query = "DELETE FROM courses WHERE courseId = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $this->courseId);
        return $stmt->execute();
    }
}
?>
