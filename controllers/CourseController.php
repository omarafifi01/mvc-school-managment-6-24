<?php
include('../includes/db.php');
include('../models/Course.php');

$course = new Course($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $course->courseName = $_POST['courseName'];
            $course->description = $_POST['description'];
            $course->teacherId = $_POST['teacherId'];
            if (!$course->addCourse()) {
                throw new Exception("Failed to add course. Please check the Teacher ID.");
            }
            header("Location: ../views/admin/courses.php");
            exit();
        } elseif ($action == 'edit') {
            $course->courseId = $_POST['courseId'];
            $course->courseName = $_POST['courseName'];
            $course->description = $_POST['description'];
            $course->teacherId = $_POST['teacherId'];
            if (!$course->updateCourse()) {
                throw new Exception("Failed to update course. Please check the Teacher ID.");
            }
            header("Location: ../views/admin/courses.php");
            exit();
        } elseif ($action == 'delete') {
            $course->courseId = $_GET['id'];
            if (!$course->deleteCourse()) {
                throw new Exception("Failed to delete course.");
            }
            header("Location: ../views/admin/courses.php");
            exit();
        }
    } catch (Exception $e) {
        // Check for foreign key constraint error
        if (strpos($e->getMessage(), 'a foreign key constraint fails') !== false) {
            $error = "Invalid teacher ID.";
        } else {
            $error = $e->getMessage();
        }
        header("Location: ../views/admin/courses.php?error=" . urlencode($error));
        exit();
    }
}
?>
