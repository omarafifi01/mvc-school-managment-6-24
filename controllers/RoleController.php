<?php
include('../includes/db.php');
include('../models/Role.php');

$role = new Role($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $role->typeName = $_POST['typeName'];
            if (!$role->addRole()) {
                throw new Exception("Failed to add role.");
            }
            header("Location: ../views/admin/roles.php");
            exit();
        } elseif ($action == 'edit') {
            $role->userTypeId = $_POST['userTypeId'];
            $role->typeName = $_POST['typeName'];
            if (!$role->updateRole()) {
                throw new Exception("Failed to update role.");
            }
            header("Location: ../views/admin/roles.php");
            exit();
        } elseif ($action == 'delete') {
            $role->userTypeId = $_GET['id'];
            if (!$role->deleteRole()) {
                throw new Exception("Failed to delete role.");
            }
            header("Location: ../views/admin/roles.php");
            exit();
        }
    } catch (Exception $e) {
        $error = $e->getMessage();
        header("Location: ../views/admin/roles.php?error=" . urlencode($error));
        exit();
    }
}
?>
