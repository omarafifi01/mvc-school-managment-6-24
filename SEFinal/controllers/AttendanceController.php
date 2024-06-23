<?php
include '../includes/init.php'; 
include '../includes/db.php';
include '../models/Attendance.php';

if (!isset($_SESSION['userId']) || $_SESSION['userRole'] != 1) {
    header("Location: ../views/login.php");
    exit();
}

$attendance = new Attendance($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $attendance->RegistrationID = $_POST['RegistrationID'];
    $attendance->Date = $_POST['Date'];
    $attendance->Status = $_POST['Status'];

    if (isset($_POST['AttendanceID']) && !empty($_POST['AttendanceID'])) {
        $attendance->AttendanceID = $_POST['AttendanceID'];
        if ($attendance->updateAttendance()) {
            echo "<p>Attendance updated successfully!</p>";
        } else {
            echo "<p>Failed to update attendance.</p>";
        }
    } else {
        if ($attendance->addAttendance()) {
            echo "<p>Attendance added successfully!</p>";
        } else {
            echo "<p>Failed to add attendance.</p>";
        }
    }
}

if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $attendance->AttendanceID = $_GET['id'];
    if ($attendance->deleteAttendance()) {
        echo "<p>Attendance deleted successfully!</p>";
    } else {
        echo "<p>Failed to delete attendance.</p>";
    }
}

$attendances = $attendance->getAllAttendances();
?>
