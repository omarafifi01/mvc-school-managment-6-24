<?php
class Student {
    public $StudentID;
    public $UserID;
    public $AdmissionNumber;
    public $DateOfBirth;

    public function __construct($StudentID, $UserID, $AdmissionNumber, $DateOfBirth) {
        $this->StudentID = $StudentID;
        $this->UserID = $UserID;
        $this->AdmissionNumber = $AdmissionNumber;
        $this->DateOfBirth = $DateOfBirth;
    }

    public static function getStudentByUserID($UserID) {
        global $conn;
        $sql = "SELECT * FROM Students WHERE UserID = '$UserID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $student = $result->fetch_assoc();
            return new Student($student['StudentID'], $student['UserID'], $student['AdmissionNumber'], $student['DateOfBirth']);
        }
        return null;
    }
}
?>
