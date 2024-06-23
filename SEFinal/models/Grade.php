<?php
class Grade {
    public $GradeID;
    public $RegistrationID;
    public $Grade;
    public $ExamID;

    public function __construct($GradeID, $RegistrationID, $Grade, $ExamID) {
        $this->GradeID = $GradeID;
        $this->RegistrationID = $RegistrationID;
        $this->Grade = $Grade;
        $this->ExamID = $ExamID;
    }

    public static function getGradesByRegistrationID($RegistrationID) {
        global $conn;
        $sql = "SELECT * FROM Grades WHERE RegistrationID = '$RegistrationID'";
        $result = $conn->query($sql);

        $grades = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $grades[] = new Grade($row['GradeID'], $row['RegistrationID'], $row['Grade'], $row['ExamID']);
            }
        }
        return $grades;
    }
}
?>
