<?php
class Exam {
    public $ExamID;
    public $CourseID;
    public $ExamDate;

    public function __construct($ExamID, $CourseID, $ExamDate) {
        $this->ExamID = $ExamID;
        $this->CourseID = $CourseID;
        $this->ExamDate = $ExamDate;
    }

    public static function getExamsByCourseID($CourseID) {
        global $conn;
        $sql = "SELECT * FROM Exams WHERE CourseID = '$CourseID'";
        $result = $conn->query($sql);

        $exams = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $exams[] = new Exam($row['ExamID'], $row['CourseID'], $row['ExamDate']);
            }
        }
        return $exams;
    }
}
?>
