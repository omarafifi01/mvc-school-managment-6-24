<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Attendance.php');

$attendance = new Attendance($conn);
$attendances = $attendance->getAllAttendance();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>Attendance Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add Attendance</h3>
        <form method="POST" action="../../controllers/AttendanceController.php?action=add" class="form-inline">
            <div class="form-group">
                <label for="registrationId">Registration ID:</label>
                <input type="number" id="registrationId" name="registrationId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="date">Date:</label>
                <input type="date" id="date" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="status">Status:</label>
                <input type="text" id="status" name="status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Attendance</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Attendance</h3>
        <form method="POST" action="../../controllers/AttendanceController.php?action=edit" class="form-inline">
            <input type="hidden" id="editAttendanceId" name="attendanceId">
            <div class="form-group">
                <label for="editRegistrationId">Registration ID:</label>
                <input type="number" id="editRegistrationId" name="registrationId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editDate">Date:</label>
                <input type="date" id="editDate" name="date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editStatus">Status:</label>
                <input type="text" id="editStatus" name="status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Attendance</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Registration ID</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $attendances->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['AttendanceID']; ?></td>
                    <td><?php echo $row['RegistrationID']; ?></td>
                    <td><?php echo $row['Date']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editAttendance('<?php echo $row['AttendanceID']; ?>', '<?php echo $row['RegistrationID']; ?>', '<?php echo $row['Date']; ?>', '<?php echo $row['Status']; ?>')">Edit</button>
                        <a href="../../controllers/AttendanceController.php?action=delete&id=<?php echo $row['AttendanceID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this attendance record?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editAttendance(attendanceId, registrationId, date, status) {
    document.getElementById('editAttendanceId').value = attendanceId;
    document.getElementById('editRegistrationId').value = registrationId;
    document.getElementById('editDate').value = date;
    document.getElementById('editStatus').value = status;
}
</script>

<?php include '../../includes/footer.php'; ?>
