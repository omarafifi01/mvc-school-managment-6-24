<?php
include('../includes/db.php');
include('../models/Grade.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $RegistrationID = $_POST['RegistrationID'];
    $Grade = $_POST['Grade'];
    $ExamID = $_POST['ExamID'];

    $sql = "INSERT INTO Grades (RegistrationID, Grade, ExamID) VALUES ('$RegistrationID', '$Grade', '$ExamID')";
    if ($conn->query($sql) === TRUE) {
        echo "Grade recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
