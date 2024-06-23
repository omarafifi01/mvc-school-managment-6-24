<?php
include('../includes/db.php');
include('../models/Payment.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $StudentID = $_POST['StudentID'];
    $Amount = $_POST['Amount'];
    $DatePaid = $_POST['DatePaid'];
    $Description = $_POST['Description'];

    $sql = "INSERT INTO Payments (StudentID, Amount, DatePaid, Description) VALUES ('$StudentID', '$Amount', '$DatePaid', '$Description')";
    if ($conn->query($sql) === TRUE) {
        echo "Payment recorded successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
