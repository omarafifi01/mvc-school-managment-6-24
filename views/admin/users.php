<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/User.php');

$user = new User($conn);
$users = $user->getAllUsers();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>User Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add User</h3>
        <form method="POST" action="../../controllers/UserController.php?action=add">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="userTypeId">User Type ID:</label>
                <input type="number" id="userTypeId" name="userTypeId" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" required style="width: 250px;">
            </div>
            <button type="submit" class="btn btn-success">Add User</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit User</h3>
        <form method="POST" action="../../controllers/UserController.php?action=edit">
            <input type="hidden" id="editUserId" name="userId">
            <div class="form-group">
                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="username" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="editPassword">Password:</label>
                <input type="password" id="editPassword" name="password" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="editUserTypeId">User Type ID:</label>
                <input type="number" id="editUserTypeId" name="userTypeId" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="editName">Name:</label>
                <input type="text" id="editName" name="name" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="email" class="form-control" required style="width: 250px;">
            </div>
            <div class="form-group">
                <label for="editPhone">Phone:</label>
                <input type="text" id="editPhone" name="phone" class="form-control" required style="width: 250px;">
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Users</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>User Type ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $users->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['UserID']; ?></td>
                    <td><?php echo $row['Username']; ?></td>
                    <td><?php echo $row['UserTypeID']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editUser('<?php echo $row['UserID']; ?>', '<?php echo $row['Username']; ?>', '<?php echo $row['UserTypeID']; ?>', '<?php echo $row['Name']; ?>', '<?php echo $row['Email']; ?>', '<?php echo $row['Phone']; ?>')">Edit</button>
                        <a href="../../controllers/UserController.php?action=delete&id=<?php echo $row['UserID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editUser(userId, username, userTypeId, name, email, phone) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editUsername').value = username;
    document.getElementById('editUserTypeId').value = userTypeId;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
}
</script>

<?php include '../../includes/footer.php'; ?>
