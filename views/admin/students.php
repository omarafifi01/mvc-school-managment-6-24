<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Student.php');

$students = [];
$sql = "SELECT * FROM Students";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}
?>

<h2>Students</h2>
<table>
    <tr>
        <th>Student ID</th>
        <th>Admission Number</th>
        <th>Date of Birth</th>
        <th>User ID</th>
    </tr>
    <?php foreach ($students as $student): ?>
        <tr>
            <td><?php echo $student['StudentID']; ?></td>
            <td><?php echo $student['AdmissionNumber']; ?></td>
            <td><?php echo $student['DateOfBirth']; ?></td>
            <td><?php echo $student['UserID']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="../../controllers/StudentController.php" method="post">
    <label for="UserID">User ID:</label>
    <input type="text" id="UserID" name="UserID" required>
    <label for="AdmissionNumber">Admission Number:</label>
    <input type="text" id="AdmissionNumber" name="AdmissionNumber" required>
    <label for="DateOfBirth">Date of Birth:</label>
    <input type="date" id="DateOfBirth" name="DateOfBirth" required>
    <button type="submit">Add Student</button>
</form>

<?php
include('../../includes/footer.php');
?>
