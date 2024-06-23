<?php
include('../includes/header.php');
include('../includes/db.php');
include('../models/User.php');

session_start();
if (!isset($_SESSION['UserID'])) {
    header("Location: login.php");
    exit();
}

$UserID = $_SESSION['UserID'];
$sql = "SELECT * FROM Users WHERE UserID = '$UserID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "User not found.";
}
?>

<h2>Profile</h2>
<p><strong>Name:</strong> <?php echo $user['Name']; ?></p>
<p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
<p><strong>Phone:</strong> <?php echo $user['Phone']; ?></p>

<?php
include('../includes/footer.php');
?>
