<?php
include('../includes/db.php');
include('../models/Teacher.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $EmployeeID = $_POST['EmployeeID'];

    $sql = "INSERT INTO Teachers (UserID, EmployeeID) VALUES ('$UserID', '$EmployeeID')";
    if ($conn->query($sql) === TRUE) {
        echo "Teacher added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
