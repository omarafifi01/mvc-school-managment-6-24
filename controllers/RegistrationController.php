<?php
include('../includes/db.php');
include('../models/Registration.php');

$registration = new Registration($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $registration->studentId = $_POST['studentId'];
            $registration->courseId = $_POST['courseId'];
            $registration->registrationDate = $_POST['registrationDate'];
            if (!$registration->addRegistration()) {
                throw new Exception("Failed to add registration.");
            }
            header("Location: ../views/admin/registrations.php");
            exit();
        } elseif ($action == 'edit') {
            $registration->registrationId = $_POST['registrationId'];
            $registration->studentId = $_POST['studentId'];
            $registration->courseId = $_POST['courseId'];
            $registration->registrationDate = $_POST['registrationDate'];
            if (!$registration->updateRegistration()) {
                throw new Exception("Failed to update registration.");
            }
            header("Location: ../views/admin/registrations.php");
            exit();
        } elseif ($action == 'delete') {
            $registration->registrationId = $_GET['id'];
            if (!$registration->deleteRegistration()) {
                throw new Exception("Failed to delete registration.");
            }
            header("Location: ../views/admin/registrations.php");
            exit();
        }
    } catch (Exception $e) {
        if ($conn->errno == 1452) { // Foreign key constraint fails
            $error = "Invalid student or course!";
        } else {
            $error = $e->getMessage();
        }
        header("Location: ../views/admin/registrations.php?error=" . urlencode($error));
        exit();
    }
}
?>
