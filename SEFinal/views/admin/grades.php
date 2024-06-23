<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Grade.php');

$grades = [];
$sql = "SELECT * FROM Grades";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $grades[] = $row;
    }
}
?>

<h2>Grades</h2>
<table>
    <tr>
        <th>Grade ID</th>
        <th>Registration ID</th>
        <th>Grade</th>
        <th>Exam ID</th>
    </tr>
    <?php foreach ($grades as $grade): ?>
        <tr>
            <td><?php echo $grade['GradeID']; ?></td>
            <td><?php echo $grade['RegistrationID']; ?></td>
            <td><?php echo $grade['Grade']; ?></td>
            <td><?php echo $grade['ExamID']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="../../controllers/GradeController.php" method="post">
    <label for="RegistrationID">Registration ID:</label>
    <input type="text" id="RegistrationID" name="RegistrationID" required>
    <label for="Grade">Grade:</label>
    <input type="text" id="Grade" name="Grade" required>
    <label for="ExamID">Exam ID:</label>
    <input type="text" id="ExamID" name="ExamID" required>
    <button type="submit">Add Grade</button>
</form>

<?php
include('../../includes/footer.php');
?>
