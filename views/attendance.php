<?php
include('../includes/header.php');
include('../includes/db.php');
include('../models/Attendance.php');

$attendance = new Attendance($conn);
$attendances = $attendance->getAllAttendance();
?>

<div class="container">
    <h2>Attendance Records</h2>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Registration ID</th>
                <th>Date</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $attendances->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['AttendanceID']; ?></td>
                    <td><?php echo $row['RegistrationID']; ?></td>
                    <td><?php echo $row['Date']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
