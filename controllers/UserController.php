<?php
include('../includes/db.php');
include('../models/User.php');

$user = new User($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->userTypeId = $_POST['userTypeId'];
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->phone = $_POST['phone'];
            if (!$user->addUser()) {
                throw new Exception("Failed to add user. Username might already exist.");
            }
            header("Location: ../views/admin/users.php");
            exit();
        } elseif ($action == 'edit') {
            $user->userId = $_POST['userId'];
            $user->username = $_POST['username'];
            $user->password = $_POST['password'];
            $user->userTypeId = $_POST['userTypeId'];
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];
            $user->phone = $_POST['phone'];
            if (!$user->updateUser()) {
                throw new Exception("Failed to update user.");
            }
            header("Location: ../views/admin/users.php");
            exit();
        } elseif ($action == 'delete') {
            $user->userId = $_GET['id'];
            if (!$user->deleteUser()) {
                throw new Exception("Failed to delete user.");
            }
            header("Location: ../views/admin/users.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        header("Location: ../views/admin/users.php?error=" . urlencode($error));
        exit();
    }
}
?>
