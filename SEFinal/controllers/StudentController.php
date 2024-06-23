<?php
include('../includes/db.php');
include('../models/Student.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $AdmissionNumber = $_POST['AdmissionNumber'];
    $DateOfBirth = $_POST['DateOfBirth'];

    $sql = "INSERT INTO Students (UserID, AdmissionNumber, DateOfBirth) VALUES ('$UserID', '$AdmissionNumber', '$DateOfBirth')";
    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
