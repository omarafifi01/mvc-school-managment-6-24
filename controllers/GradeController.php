<?php
include('../includes/db.php');
include('../models/Grade.php');

$grade = new Grade($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $grade->registrationId = $_POST['registrationId'];
            $grade->grade = $_POST['grade'];
            $grade->examId = $_POST['examId']; // Add this line
            if (!$grade->addGrade()) {
                throw new Exception("Failed to add grade.");
            }
            header("Location: ../views/admin/grades.php");
            exit();
        } elseif ($action == 'edit') {
            $grade->gradeId = $_POST['gradeId'];
            $grade->registrationId = $_POST['registrationId'];
            $grade->grade = $_POST['grade'];
            $grade->examId = $_POST['examId']; // Add this line
            if (!$grade->updateGrade()) {
                throw new Exception("Failed to update grade.");
            }
            header("Location: ../views/admin/grades.php");
            exit();
        } elseif ($action == 'delete') {
            $grade->gradeId = $_GET['id'];
            if (!$grade->deleteGrade()) {
                throw new Exception("Failed to delete grade.");
            }
            header("Location: ../views/admin/grades.php");
            exit();
        }
    } catch (Exception $e) {
        if ($conn->errno == 1452) { // Foreign key constraint fails
            $error = "Invalid student!";
        } else {
            $error = $e->getMessage();
        }
        header("Location: ../views/admin/grades.php?error=" . urlencode($error));
        exit();
    }
}
?>
