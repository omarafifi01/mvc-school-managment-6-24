<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Payment.php');

$payment = new Payment($conn);
$payments = $payment->getAllPayments();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>Payment Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add Payment</h3>
        <form method="POST" action="../../controllers/PaymentController.php?action=add">
            <div class="form-group">
                <label for="studentId">Student ID:</label>
                <input type="number" id="studentId" name="studentId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="amount">Amount:</label>
                <input type="number" step="0.01" id="amount" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="datePaid">Date Paid:</label>
                <input type="date" id="datePaid" name="datePaid" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control">
            </div>
            <button type="submit" class="btn btn-success">Add Payment</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Payment</h3>
        <form method="POST" action="../../controllers/PaymentController.php?action=edit">
            <input type="hidden" id="editPaymentId" name="paymentId">
            <div class="form-group">
                <label for="editStudentId">Student ID:</label>
                <input type="number" id="editStudentId" name="studentId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editAmount">Amount:</label>
                <input type="number" step="0.01" id="editAmount" name="amount" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editDatePaid">Date Paid:</label>
                <input type="date" id="editDatePaid" name="datePaid" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editDescription">Description:</label>
                <input type="text" id="editDescription" name="description" class="form-control">
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Payments</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Amount</th>
                <th>Date Paid</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $payments->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['PaymentID']; ?></td>
                    <td><?php echo $row['StudentID']; ?></td>
                    <td><?php echo $row['Amount']; ?></td>
                    <td><?php echo $row['DatePaid']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editPayment('<?php echo $row['PaymentID']; ?>', '<?php echo $row['StudentID']; ?>', '<?php echo $row['Amount']; ?>', '<?php echo $row['DatePaid']; ?>', '<?php echo $row['Description']; ?>')">Edit</button>
                        <a href="../../controllers/PaymentController.php?action=delete&id=<?php echo $row['PaymentID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this payment?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editPayment(paymentId, studentId, amount, datePaid, description) {
    document.getElementById('editPaymentId').value = paymentId;
    document.getElementById('editStudentId').value = studentId;
    document.getElementById('editAmount').value = amount;
    document.getElementById('editDatePaid').value = datePaid;
    document.getElementById('editDescription').value = description;
}
</script>

<?php include '../../includes/footer.php'; ?>
