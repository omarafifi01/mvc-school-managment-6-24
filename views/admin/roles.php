<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Role.php');

$role = new Role($conn);
$roles = $role->getAllRoles();
$error = isset($_GET['error']) ? urldecode($_GET['error']) : '';
?>

<div class="container">
    <h2>Role Management</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <div class="form-section">
        <h3>Add Role</h3>
        <form method="POST" action="../../controllers/RoleController.php?action=add">
            <div class="form-group">
                <label for="typeName">Role Name:</label>
                <input type="text" id="typeName" name="typeName" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Role</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Role</h3>
        <form method="POST" action="../../controllers/RoleController.php?action=edit">
            <input type="hidden" id="editUserTypeId" name="userTypeId">
            <div class="form-group">
                <label for="editTypeName">Role Name:</label>
                <input type="text" id="editTypeName" name="typeName" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Roles</h3>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Role Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $roles->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['UserTypeID']; ?></td>
                    <td><?php echo $row['TypeName']; ?></td>
                    <td>
                        <button class="btn btn-warning" onclick="editRole('<?php echo $row['UserTypeID']; ?>', '<?php echo $row['TypeName']; ?>')">Edit</button>
                        <a href="../../controllers/RoleController.php?action=delete&id=<?php echo $row['UserTypeID']; ?>" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this role?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editRole(userTypeId, typeName) {
    document.getElementById('editUserTypeId').value = userTypeId;
    document.getElementById('editTypeName').value = typeName;
}
</script>

<?php include '../../includes/footer.php'; ?>
