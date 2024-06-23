<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Exam.php');

$exam = new Exam($conn);
$exams = $exam->getAllExams();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>Exam Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add Exam</h3>
        <form method="POST" action="../../controllers/ExamController.php?action=add">
            <div class="form-group">
                <label for="courseId">Course ID:</label>
                <input type="number" id="courseId" name="courseId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="examDate">Exam Date:</label>
                <input type="date" id="examDate" name="examDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Exam</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Exam</h3>
        <form method="POST" action="../../controllers/ExamController.php?action=edit">
            <input type="hidden" id="editExamId" name="examId">
            <div class="form-group">
                <label for="editCourseId">Course ID:</label>
                <input type="number" id="editCourseId" name="courseId" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editExamDate">Exam Date:</label>
                <input type="date" id="editExamDate" name="examDate" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Exams</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course ID</th>
                <th>Exam Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $exams->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['ExamID']; ?></td>
                    <td><?php echo $row['CourseID']; ?></td>
                    <td><?php echo $row['ExamDate']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editExam('<?php echo $row['ExamID']; ?>', '<?php echo $row['CourseID']; ?>', '<?php echo $row['ExamDate']; ?>')">Edit</button>
                        <a href="../../controllers/ExamController.php?action=delete&id=<?php echo $row['ExamID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this exam?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editExam(examId, courseId, examDate) {
    document.getElementById('editExamId').value = examId;
    document.getElementById('editCourseId').value = courseId;
    document.getElementById('editExamDate').value = examDate;
}
</script>

<?php include '../../includes/footer.php'; ?>
