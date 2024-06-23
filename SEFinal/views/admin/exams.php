<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Exam.php');

$exams = [];
$sql = "SELECT * FROM Exams";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $exams[] = $row;
    }
}
?>

<h2>Exams</h2>
<table>
    <tr>
        <th>Exam ID</th>
        <th>Course ID</th>
        <th>Exam Date</th>
    </tr>
    <?php foreach ($exams as $exam): ?>
        <tr>
            <td><?php echo $exam['ExamID']; ?></td>
            <td><?php echo $exam['CourseID']; ?></td>
            <td><?php echo $exam['ExamDate']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="../../controllers/ExamController.php" method="post">
    <label for="CourseID">Course ID:</label>
    <input type="text" id="CourseID" name="CourseID" required>
    <label for="ExamDate">Exam Date:</label>
    <input type="date" id="ExamDate" name="ExamDate" required>
    <button type="submit">Add Exam</button>
</form>

<?php
include('../../includes/footer.php');
?>
