<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/User.php');

$user = new User($conn);
$users = $user->getAllUsers();
?>

<div class="container">
    <h2>Users Management</h2>

    <?php
    if (isset($_GET['status'])) {
        if ($_GET['status'] == 'added') {
            echo "<div class='alert alert-success'>User added successfully!</div>";
        } elseif ($_GET['status'] == 'updated') {
            echo "<div class='alert alert-success'>User updated successfully!</div>";
        } elseif ($_GET['status'] == 'deleted') {
            echo "<div class='alert alert-success'>User deleted successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Operation failed. Please try again.</div>";
        }
    }
    ?>

    <div class="form-section">
        <h3>Add User</h3>
        <form method="POST" action="../controllers/UserController.php" class="form-inline">
            <input type="hidden" name="userId" value="">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="userTypeId">Role:</label>
                <select id="userTypeId" name="userTypeId" class="form-control" required>
                    <option value="1">Admin</option>
                    <option value="2">Teacher</option>
                    <option value="3">Student</option>
                </select>
            </div>
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add User</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit User</h3>
        <form method="POST" action="../../controllers/UserController.php" class="form-inline">
            <input type="hidden" id="editUserId" name="userId">
            <div class="form-group">
                <label for="editUsername">Username:</label>
                <input type="text" id="editUsername" name="username" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editPassword">Password:</label>
                <input type="password" id="editPassword" name="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editUserTypeId">Role:</label>
                <select id="editUserTypeId" name="userTypeId" class="form-control" required>
                    <option value="1">Admin</option>
                    <option value="2">Teacher</option>
                    <option value="3">Student</option>
                </select>
            </div>
            <div class="form-group">
                <label for="editName">Name:</label>
                <input type="text" id="editName" name="name" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editEmail">Email:</label>
                <input type="email" id="editEmail" name="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editPhone">Phone:</label>
                <input type="text" id="editPhone" name="phone" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Users</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Username</th>
                <th>Password</th>
                <th>Role</th>
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
                    <td><?php echo $row['Password']; ?></td>
                    <td><?php echo $row['UserTypeID']; ?></td>
                    <td><?php echo $row['Name']; ?></td>
                    <td><?php echo $row['Email']; ?></td>
                    <td><?php echo $row['Phone']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editUser('<?php echo $row['UserID']; ?>', '<?php echo $row['Username']; ?>', '<?php echo $row['Password']; ?>', '<?php echo $row['UserTypeID']; ?>', '<?php echo $row['Name']; ?>', '<?php echo $row['Email']; ?>', '<?php echo $row['Phone']; ?>')">Edit</button>
                        <a class="btn btn-sm btn-danger" href="../../controllers/UserController.php?action=delete&id=<?php echo $row['UserID']; ?>" onclick="return confirm('Are you sure you want to delete this user?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editUser(userId, username, password, userTypeId, name, email, phone) {
    document.getElementById('editUserId').value = userId;
    document.getElementById('editUsername').value = username;
    document.getElementById('editPassword').value = password;
    document.getElementById('editUserTypeId').value = userTypeId;
    document.getElementById('editName').value = name;
    document.getElementById('editEmail').value = email;
    document.getElementById('editPhone').value = phone;
}
</script>

<?php
include('../../includes/footer.php');
?>
