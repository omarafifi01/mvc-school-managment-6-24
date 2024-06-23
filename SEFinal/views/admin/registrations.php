<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Registration.php');

$registrations = [];
$sql = "SELECT * FROM Registrations";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $registrations[] = $row;
    }
}
?>

<h2>Registrations</h2>
<table>
    <tr>
        <th>Registration ID</th>
        <th>Student ID</th>
        <th>Course ID</th>
        <th>Registration Date</th>
    </tr>
    <?php foreach ($registrations as $registration): ?>
        <tr>
            <td><?php echo $registration['RegistrationID']; ?></td>
            <td><?php echo $registration['StudentID']; ?></td>
            <td><?php echo $registration['CourseID']; ?></td>
            <td><?php echo $registration['RegistrationDate']; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="../../controllers/RegistrationController.php" method="post">
    <label for="StudentID">Student ID:</label>
    <input type="text" id="StudentID" name="StudentID" required>
    <label for="CourseID">Course ID:</label>
    <input type="text" id="CourseID" name="CourseID" required>
    <label for="RegistrationDate">Registration Date:</label>
    <input type="date" id="RegistrationDate" name="RegistrationDate" required>
    <button type="submit">Add Registration</button>
</form>

<?php
include('../../includes/footer.php');
?>
