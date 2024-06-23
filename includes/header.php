<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="/SEFinal/css/style.css">
    <title>Kipling School</title>
</head>
<body>
<?php if (isset($_SESSION['user_id'])): ?>
<header class="bg-dark text-white p-3">
    <div class="container">
        <h1 class="text-center">Kipling School</h1>
        <nav class="nav justify-content-center">
            <a class="nav-link text-white" href="/SEFinal/index.php">Home</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/users.php">Users</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/roles.php">Roles</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/courses.php">Courses</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/attendance.php">Attendance</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/grades.php">Grades</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/exams.php">Exams</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/payments.php">Payments</a>
            <a class="nav-link text-white" href="/SEFinal/views/admin/registrations.php">Registrations</a>
            <a class="nav-link text-white" href="/SEFinal/views/profile.php">Profile</a>
            <a class="nav-link text-white" href="/SEFinal/views/logout.php">Logout</a>
        </nav>
    </div>
</header>
<?php endif; ?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
