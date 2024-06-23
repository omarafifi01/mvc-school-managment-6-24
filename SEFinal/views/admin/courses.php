<?php
include('../../includes/header.php');
include('../../includes/db.php');
include('../../models/Course.php');

$course = new Course($conn);
$courses = $course->getAllCourses();
?>

<div class="container">
    <h2>Courses Management</h2>

    <div class="form-section">
        <h3>Add Course</h3>
        <form method="POST" action="../../controllers/CourseController.php" class="form-inline">
            <input type="hidden" name="courseId" value="">
            <div class="form-group">
                <label for="courseName">Course Name:</label>
                <input type="text" id="courseName" name="courseName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <input type="text" id="description" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="teacherId">Teacher ID:</label>
                <input type="number" id="teacherId" name="teacherId" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-success">Add Course</button>
        </form>
    </div>

    <div class="form-section">
        <h3>Edit Course</h3>
        <form method="POST" action="../../controllers/CourseController.php" class="form-inline">
            <input type="hidden" id="editCourseId" name="courseId">
            <div class="form-group">
                <label for="editCourseName">Course Name:</label>
                <input type="text" id="editCourseName" name="courseName" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editDescription">Description:</label>
                <input type="text" id="editDescription" name="description" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="editTeacherId">Teacher ID:</label>
                <input type="number" id="editTeacherId" name="teacherId" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>

    <h3>All Courses</h3>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Course Name</th>
                <th>Description</th>
                <th>Teacher ID</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $courses->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['CourseID']; ?></td>
                    <td><?php echo $row['CourseName']; ?></td>
                    <td><?php echo $row['Description']; ?></td>
                    <td><?php echo $row['TeacherID']; ?></td>
                    <td>
                        <button class="btn btn-sm btn-warning" onclick="editCourse('<?php echo $row['CourseID']; ?>', '<?php echo $row['CourseName']; ?>', '<?php echo $row['Description']; ?>', '<?php echo $row['TeacherID']; ?>')">Edit</button>
                        <a class="btn btn-sm btn-danger" href="../../controllers/CourseController.php?action=delete&id=<?php echo $row['CourseID']; ?>" onclick="return confirm('Are you sure you want to delete this course?');">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
function editCourse(courseId, courseName, description, teacherId) {
    document.getElementById('editCourseId').value = courseId;
    document.getElementById('editCourseName').value = courseName;
    document.getElementById('editDescription').value = description;
    document.getElementById('editTeacherId').value = teacherId;
}
</script>

<?php
include('../../includes/footer.php');
?>
