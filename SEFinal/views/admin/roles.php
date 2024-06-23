<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Role.php');

$roles = Role::getAllRoles();
?>

<h2>Roles</h2>
<table>
    <tr>
        <th>Role ID</th>
        <th>Role Name</th>
    </tr>
    <?php foreach ($roles as $role): ?>
        <tr>
            <td><?php echo $role->UserTypeID; ?></td>
            <td><?php echo $role->TypeName; ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<form action="../../controllers/RoleController.php" method="post">
    <label for="TypeName">New Role Name:</label>
    <input type="text" id="TypeName" name="TypeName" required>
    <button type="submit">Add Role</button>
</form>

<?php
include('../../includes/footer.php');
?>
