<?php
include('../includes/db.php');
include('../models/Registration.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $StudentID = $_POST['StudentID'];
    $CourseID = $_POST['CourseID'];
    $RegistrationDate = $_POST['RegistrationDate'];

    $sql = "INSERT INTO Registrations (StudentID, CourseID, RegistrationDate) VALUES ('$StudentID', '$CourseID', '$RegistrationDate')";
    if ($conn->query($sql) === TRUE) {
        echo "Registration recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
