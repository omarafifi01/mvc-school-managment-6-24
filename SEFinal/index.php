<?php
include('includes/header.php');
?>

<main class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-5 bg-overlay rounded shadow">
        <?php if (!isset($_SESSION['user_id'])): ?>
            <h1 class="display-4">Welcome to Kipling School</h1>
            <p class="lead">At Kipling School, we aim to be active learners who are not afraid to take risks, differentiate teaching, encourage creativity, provide contextual learning, foster integrity, respect the environment, ensure equality, and value our cultural identity and that of others.</p>
            <div class="d-flex justify-content-center mt-4">
                <a href="views/login.php" class="btn btn-lg btn-primary mx-2">Login</a>
                <a href="views/register.php" class="btn btn-lg btn-success mx-2">Register</a>
            </div>
        <?php else: ?>
            <h1 class="display-4">Welcome, <?php echo $_SESSION['role']; ?></h1>
            <p class="lead">Here you can manage your courses, attendance, grades, exams, and profile.</p>
        <?php endif; ?>
    </div>
</main>

<?php
include('includes/footer.php');
?>
