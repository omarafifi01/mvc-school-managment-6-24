<?php
include('../includes/db.php');
include('../models/Attendance.php');

$attendance = new Attendance($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $attendance->registrationId = $_POST['registrationId'];
            $attendance->date = $_POST['date'];
            $attendance->status = $_POST['status'];
            if (!$attendance->addAttendance()) {
                throw new Exception("Failed to add attendance. Please check the Registration ID.");
            }
            header("Location: ../views/admin/attendance.php");
            exit();
        } elseif ($action == 'edit') {
            $attendance->attendanceId = $_POST['attendanceId'];
            $attendance->registrationId = $_POST['registrationId'];
            $attendance->date = $_POST['date'];
            $attendance->status = $_POST['status'];
            if (!$attendance->updateAttendance()) {
                throw new Exception("Failed to update attendance. Please check the Registration ID.");
            }
            header("Location: ../views/admin/attendance.php");
            exit();
        } elseif ($action == 'delete') {
            $attendance->attendanceId = $_GET['id'];
            if (!$attendance->deleteAttendance()) {
                throw new Exception("Failed to delete attendance.");
            }
            header("Location: ../views/admin/attendance.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        header("Location: ../views/admin/attendance.php?error=" . urlencode($error));
        exit();
    }
}
?>
