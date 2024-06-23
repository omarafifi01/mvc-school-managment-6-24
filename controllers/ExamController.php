<?php
include('../includes/db.php');
include('../models/Exam.php');

$exam = new Exam($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $exam->courseId = $_POST['courseId'];
            $exam->examDate = $_POST['examDate'];
            if (!$exam->addExam()) {
                throw new Exception("Failed to add exam.");
            }
            header("Location: ../views/admin/exams.php");
            exit();
        } elseif ($action == 'edit') {
            $exam->examId = $_POST['examId'];
            $exam->courseId = $_POST['courseId'];
            $exam->examDate = $_POST['examDate'];
            if (!$exam->updateExam()) {
                throw new Exception("Failed to update exam.");
            }
            header("Location: ../views/admin/exams.php");
            exit();
        } elseif ($action == 'delete') {
            $exam->examId = $_GET['id'];
            if (!$exam->deleteExam()) {
                throw new Exception("Failed to delete exam.");
            }
            header("Location: ../views/admin/exams.php");
            exit();
        }
    } catch (Exception $e) {
        if ($conn->errno == 1452) { // Foreign key constraint fails
            $error = "Invalid course!";
        } else {
            $error = $e->getMessage();
        }
        header("Location: ../views/admin/exams.php?error=" . urlencode($error));
        exit();
    }
}
?>
