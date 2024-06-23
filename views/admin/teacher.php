<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Teacher.php');

$teachers = [];
$sql = "SELECT * FROM Teachers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $teachers[] = $row;
    }
}
?>

<h2>Teachers</h2>
<table>
    <tr>
        <th>Teacher ID</th>
        <th>Employee ID</th>
        <th>User ID</th>
    </tr>
    <?php foreach ($teachers as $teacher): ?>
        <tr>
            <td><?php echo $teacher['TeacherID']; ?></td>
            <td><?php echo $teacher['EmployeeID']; ?></td>
            <td><?php echo $teacher['UserID']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="../../controllers/TeacherController.php" method="post">
    <label for="UserID">User ID:</label>
    <input type="text" id="UserID" name="UserID" required>
    <label for="EmployeeID">Employee ID:</label>
    <input type="text" id="EmployeeID" name="EmployeeID" required>
    <button type="submit">Add Teacher</button>
</form>

<?php
include('../../includes/footer.php');
?>
