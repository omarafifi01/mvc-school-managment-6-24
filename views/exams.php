<?php
include('../includes/header.php');
include('../includes/db.php');
include('../models/Exam.php');

$courseID = 1; // Example course ID
$exams = Exam::getExamsByCourseID($courseID);
?>

<h2>Exams</h2>
<ul>
    <?php foreach ($exams as $exam): ?>
        <li><?php echo $exam->ExamDate; ?></li>
    <?php endforeach; ?>
</ul>

<?php
include('../includes/footer.php');
?>
