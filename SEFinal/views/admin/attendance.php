<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Attendance.php');

$attendance = new Attendance($conn);
$attendances = $attendance->getAllAttendances();
?>

<div class="container">
    <h2>Attendance Management</h2>

    <div class="form-section">
        <h3>Add Attendance</h3>
        <form method="POST" action="../../controllers/AttendanceController.php" class="form-inline">
            <input type="hidden" name="AttendanceID" value="">
            <div class="form-group">
                <label for="RegistrationID">Registration ID:</label>
                <input type="number" id="RegistrationID" name="RegistrationID" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Date">Date:</label>
                <input type="date" id="Date" name="Date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="Status">Status:</label>
                <input type="text" id="Status" name="Status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Attendance</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Attendance</h3>
        <form method="POST" action="../../controllers/AttendanceController.php" class="form-inline">
            <input type="hidden" id="editAttendanceID" name="AttendanceID">
            <div class="form-group">
                <label for="editRegistrationID">Registration ID:</label>
                <input type="number" id="editRegistrationID" name="RegistrationID" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editDate">Date:</label>
                <input type="date" id="editDate" name="Date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editStatus">Status:</label>
                <input type="text" id="editStatus" name="Status" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Attendance Records</h3>
    <table class="table table-striped">
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
                        <button class="btn btn-sm btn-warning" onclick="editAttendance('<?php echo $row['AttendanceID']; ?>', '<?php echo $row['RegistrationID']; ?>', '<?php echo $row['Date']; ?>', '<?php echo $row['Status']; ?>')">Edit</button>
                        <a class="btn btn-sm btn-danger" href="../../controllers/AttendanceController.php?action=delete&id=<?php echo $row['AttendanceID']; ?>" onclick="return confirm('Are you sure you want to delete this attendance record?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editAttendance(AttendanceID, RegistrationID, Date, Status) {
    document.getElementById('editAttendanceID').value = AttendanceID;
    document.getElementById('editRegistrationID').value = RegistrationID;
    document.getElementById('editDate').value = Date;
    document.getElementById('editStatus').value = Status;
}
</script>

<?php include '../../includes/footer.php'; ?>
