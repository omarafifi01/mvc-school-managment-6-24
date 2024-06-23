<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header('Location: ../index.php');
    exit();
}
include('../includes/header.php');
include('../includes/db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $sql = "SELECT Users.*, UserTypes.TypeName 
            FROM Users 
            JOIN UserTypes ON Users.UserTypeID = UserTypes.UserTypeID 
            WHERE Users.username='$username' AND Users.password='$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if ($user['TypeName'] == 'Admin' || $user['TypeName'] == 'Teacher') {
            $_SESSION['user_id'] = $user['UserID'];
            $_SESSION['role'] = $user['TypeName'];
            header('Location: ../index.php');
        } else {
            $error = "Access restricted to Admins and Teachers only.";
        }
    } else {
        $error = "Invalid username or password.";
    }
}

?>

<main class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-5 bg-overlay rounded shadow">
        <h1 class="display-4">Login</h1>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="username" class="text-white">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password" class="text-white">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-lg btn-primary">Login</button>
        </form>
    </div>
</main>

<?php
include('../includes/footer.php');
?>
