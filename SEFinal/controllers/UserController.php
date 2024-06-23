<?php
include '../includes/init.php'; 
include '../includes/db.php';
include '../models/User.php';

if (!isset($_SESSION['userId']) || $_SESSION['userRole'] != 1) {
    header("Location: ../views/login.php");
    exit();
}

$user = new User($conn);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user->username = $_POST['username'];
    $user->password = $_POST['password'];
    $user->userTypeId = $_POST['userTypeId'];
    $user->name = $_POST['name'];
    $user->email = $_POST['email'];
    $user->phone = $_POST['phone'];

    if (isset($_POST['userId']) && !empty($_POST['userId'])) {
        // Update existing user
        $user->userId = $_POST['userId'];
        if ($user->updateUser()) {
            header("Location: ../views/admin/users.php?status=updated");
        } else {
            header("Location: ../views/admin/users.php?status=failed");
        }
    } else {
        // Add new user
        if ($user->addUser()) {
            header("Location: ../views/admin/users.php?status=added");
        } else {
            header("Location: ../views/admin/users.php?status=failed");
        }
    }
    exit();
}

// Handle delete user request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $user->userId = $_GET['id'];
    if ($user->deleteUser()) {
        header("Location: ../views/admin/users.php?status=deleted");
    } else {
        header("Location: ../views/admin/users.php?status=failed");
    }
    exit();
}

header("Location: ../views/admin/users.php");
exit();
?>
