<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Grade.php');

$grade = new Grade($conn);
$grades = $grade->getAllGrades();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>Grade Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add Grade</h3>
        <form method="POST" action="../../controllers/GradeController.php?action=add">
            <div class="form-group">
                <label for="registrationId">Registration ID:</label>
                <input type="number" id="registrationId" name="registrationId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="examId">Exam ID:</label>
                <input type="number" id="examId" name="examId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="grade">Grade:</label>
                <input type="text" id="grade" name="grade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Grade</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Grade</h3>
        <form method="POST" action="../../controllers/GradeController.php?action=edit">
            <input type="hidden" id="editGradeId" name="gradeId">
            <div class="form-group">
                <label for="editRegistrationId">Registration ID:</label>
                <input type="number" id="editRegistrationId" name="registrationId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editExamId">Exam ID:</label>
                <input type="number" id="editExamId" name="examId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editGrade">Grade:</label>
                <input type="text" id="editGrade" name="grade" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Grades</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Registration ID</th>
                <th>Exam ID</th>
                <th>Grade</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $grades->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['GradeID']; ?></td>
                    <td><?php echo $row['RegistrationID']; ?></td>
                    <td><?php echo $row['ExamID']; ?></td>
                    <td><?php echo $row['Grade']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editGrade('<?php echo $row['GradeID']; ?>', '<?php echo $row['RegistrationID']; ?>', '<?php echo $row['ExamID']; ?>', '<?php echo $row['Grade']; ?>')">Edit</button>
                        <a href="../../controllers/GradeController.php?action=delete&id=<?php echo $row['GradeID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this grade?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editGrade(gradeId, registrationId, examId, grade) {
    document.getElementById('editGradeId').value = gradeId;
    document.getElementById('editRegistrationId').value = registrationId;
    document.getElementById('editExamId').value = examId;
    document.getElementById('editGrade').value = grade;
}
</script>

<?php include '../../includes/footer.php'; ?>
