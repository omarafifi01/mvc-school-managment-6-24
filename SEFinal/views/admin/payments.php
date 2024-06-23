<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Payment.php');


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$payments = [];
$sql = "SELECT * FROM Payments";
$result = $conn->query($sql);

if ($result === FALSE) {
    die("Error: " . $conn->error);
}

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $payments[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <title>Payments</title>
</head>
<body>
    <div class="container">
        <h2><br>Payments</h2>
        <table class="table table-bordered">
            <tr>
                <th>Payment ID</th>
                <th>Student ID</th>
                <th>Amount</th>
                <th>Date Paid</th>
                <th>Description</th>
            </tr>
            <?php foreach ($payments as $payment): ?>
                <tr>
                    <td><?php echo htmlspecialchars($payment['PaymentID']); ?></td>
                    <td><?php echo htmlspecialchars($payment['StudentID']); ?></td>
                    <td><?php echo htmlspecialchars($payment['Amount']); ?></td>
                    <td><?php echo htmlspecialchars($payment['DatePaid']); ?></td>
                    <td><?php echo htmlspecialchars($payment['Description']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</body>
</html>


<?php
include('../../includes/footer.php');
?>