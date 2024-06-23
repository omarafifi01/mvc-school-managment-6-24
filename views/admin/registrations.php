<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Registration.php');

$registration = new Registration($conn);
$registrations = $registration->getAllRegistrations();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>Registration Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add Registration</h3>
        <form method="POST" action="../../controllers/RegistrationController.php?action=add">
            <div class="form-group">
                <label for="studentId">Student ID:</label>
                <input type="number" id="studentId" name="studentId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="courseId">Course ID:</label>
                <input type="number" id="courseId" name="courseId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="registrationDate">Registration Date:</label>
                <input type="date" id="registrationDate" name="registrationDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Registration</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Registration</h3>
        <form method="POST" action="../../controllers/RegistrationController.php?action=edit">
            <input type="hidden" id="editRegistrationId" name="registrationId">
            <div class="form-group">
                <label for="editStudentId">Student ID:</label>
                <input type="number" id="editStudentId" name="studentId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editCourseId">Course ID:</label>
                <input type="number" id="editCourseId" name="courseId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editRegistrationDate">Registration Date:</label>
                <input type="date" id="editRegistrationDate" name="registrationDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Registrations</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Student ID</th>
                <th>Course ID</th>
                <th>Registration Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $registrations->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['RegistrationID']; ?></td>
                    <td><?php echo $row['StudentID']; ?></td>
                    <td><?php echo $row['CourseID']; ?></td>
                    <td><?php echo $row['RegistrationDate']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editRegistration('<?php echo $row['RegistrationID']; ?>', '<?php echo $row['StudentID']; ?>', '<?php echo $row['CourseID']; ?>', '<?php echo $row['RegistrationDate']; ?>')">Edit</button>
                        <a href="../../controllers/RegistrationController.php?action=delete&id=<?php echo $row['RegistrationID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this registration?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editRegistration(registrationId, studentId, courseId, registrationDate) {
    document.getElementById('editRegistrationId').value = registrationId;
    document.getElementById('editStudentId').value = studentId;
    document.getElementById('editCourseId').value = courseId;
    document.getElementById('editRegistrationDate').value = registrationDate;
}
</script>

<?php include '../../includes/footer.php'; ?>
