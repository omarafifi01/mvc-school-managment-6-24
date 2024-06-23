<?php
class Teacher {
    public $TeacherID;
    public $UserID;
    public $EmployeeID;

    public function __construct($TeacherID, $UserID, $EmployeeID) {
        $this->TeacherID = $TeacherID;
        $this->UserID = $UserID;
        $this->EmployeeID = $EmployeeID;
    }

    public static function getTeacherByUserID($UserID) {
        global $conn;
        $sql = "SELECT * FROM Teachers WHERE UserID = '$UserID'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $teacher = $result->fetch_assoc();
            return new Teacher($teacher['TeacherID'], $teacher['UserID'], $teacher['EmployeeID']);
        }
        return null;
    }
}
?>
