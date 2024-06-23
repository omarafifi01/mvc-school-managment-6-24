<?php
include('../includes/db.php');
include('../models/Exam.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $CourseID = $_POST['CourseID'];
    $ExamDate = $_POST['ExamDate'];

    $sql = "INSERT INTO Exams (CourseID, ExamDate) VALUES ('$CourseID', '$ExamDate')";
    if ($conn->query($sql) === TRUE) {
        echo "Exam scheduled successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
