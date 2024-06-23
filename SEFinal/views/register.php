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
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $name = $_POST['name'];
    $user_type = $_POST['user_type'];

    // Fetch UserTypeID based on the user type selected
    $user_type_sql = "SELECT UserTypeID FROM UserTypes WHERE TypeName='$user_type'";
    $user_type_result = $conn->query($user_type_sql);
    $user_type_row = $user_type_result->fetch_assoc();
    $user_type_id = $user_type_row['UserTypeID'];

    $sql = "INSERT INTO Users (username, password, email, phone, name, UserTypeID) 
            VALUES ('$username', '$password', '$email', '$phone', '$name', '$user_type_id')";

    if ($conn->query($sql) === TRUE) {
        if ($user_type == 'Admin' || $user_type == 'Teacher') {
            $_SESSION['user_id'] = $conn->insert_id;
            $_SESSION['role'] = $user_type;
            header('Location: ../index.php');
        } else {
            $success = "Registration successful. Please wait for admin approval.";
        }
    } else {
        $error = "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>

<main class="d-flex align-items-center justify-content-center vh-100">
    <div class="text-center p-5 bg-overlay rounded shadow">
        <h1 class="display-4">Register</h1>
        <?php if (isset($error)) { echo "<div class='alert alert-danger'>$error</div>"; } ?>
        <?php if (isset($success)) { echo "<div class='alert alert-success'>$success</div>"; } ?>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="user_type">User Type:</label>
                <select id="user_type" name="user_type" class="form-control">
                    <option value="Student">Student</option>
                    <option value="Teacher">Teacher</option>
                    <option value="Admin">Admin</option>
                </select>
            </div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-lg btn-success mx-2">Register</button>
                <a href="login.php" class="btn btn-lg btn-primary mx-2">Login</a>
            </div>
        </form>
    </div>
</main>

<?php
include('../includes/footer.php');
?>
