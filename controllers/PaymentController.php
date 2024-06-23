<?php
include('../includes/db.php');
include('../models/Payment.php');

$payment = new Payment($conn);
$error = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    
    try {
        if ($action == 'add') {
            $payment->studentId = $_POST['studentId'];
            $payment->amount = $_POST['amount'];
            $payment->datePaid = $_POST['datePaid'];
            $payment->description = $_POST['description'];
            if (!$payment->addPayment()) {
                throw new Exception("Failed to add payment.");
            }
            header("Location: ../views/admin/payments.php");
            exit();
        } elseif ($action == 'edit') {
            $payment->paymentId = $_POST['paymentId'];
            $payment->studentId = $_POST['studentId'];
            $payment->amount = $_POST['amount'];
            $payment->datePaid = $_POST['datePaid'];
            $payment->description = $_POST['description'];
            if (!$payment->updatePayment()) {
                throw new Exception("Failed to update payment.");
            }
            header("Location: ../views/admin/payments.php");
            exit();
        } elseif ($action == 'delete') {
            $payment->paymentId = $_GET['id'];
            if (!$payment->deletePayment()) {
                throw new Exception("Failed to delete payment.");
            }
            header("Location: ../views/admin/payments.php");
            exit();
        }
    } catch (Exception $e) {
        if ($conn->errno == 1452) { // Foreign key constraint fails
            $error = "Invalid student!";
        } else {
            $error = $e->getMessage();
        }
        header("Location: ../views/admin/payments.php?error=" . urlencode($error));
        exit();
    }
}
?>
