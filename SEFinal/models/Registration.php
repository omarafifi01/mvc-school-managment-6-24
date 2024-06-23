<?php
class Registration {
    public $RegistrationID;
    public $StudentID;
    public $CourseID;
    public $RegistrationDate;

    public function __construct($RegistrationID, $StudentID, $CourseID, $RegistrationDate) {
        $this->RegistrationID = $RegistrationID;
        $this->StudentID = $StudentID;
        $this->CourseID = $CourseID;
        $this->RegistrationDate = $RegistrationDate;
    }

    public static function getRegistrationsByStudentID($StudentID) {
        global $conn;
        $sql = "SELECT * FROM Registrations WHERE StudentID = '$StudentID'";
        $result = $conn->query($sql);

        $registrations = [];
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $registrations[] = new Registration($row['RegistrationID'], $row['StudentID'], $row['CourseID'], $row['RegistrationDate']);
            }
        }
        return $registrations;
    }
}
?>
