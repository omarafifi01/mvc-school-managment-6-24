<?php
include('../includes/header.php');
include('../includes/db.php');
include('../models/Grade.php');

if (isset($_SESSION['UserID'])) {
    $student = Student::getStudentByUserID($_SESSION['UserID']);
    if ($student) {
        $grades = Grade::getGradesByRegistrationID($student->StudentID);
    }
}
?>

<h2>Grades</h2>
<ul>
    <?php if (!empty($grades)): ?>
        <?php foreach ($grades as $grade): ?>
            <li><?php echo $grade->Grade; ?></li>
        <?php endforeach; ?>
    <?php else: ?>
        <li>No grades found.</li>
    <?php endif; ?>
</ul>

<?php
include('../includes/footer.php');
?>
