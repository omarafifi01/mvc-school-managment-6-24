<?php
include '../includes/init.php'; 
include '../includes/header.php';
include '../includes/db.php';
include '../models/Course.php';

if (!isset($_SESSION['userId']) || $_SESSION['userRole'] != 1) {
    header("Location: ../views/login.php");
    exit();
}

$course = new Course($conn);

// Handle add/edit course request
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $course->courseName = $_POST['courseName'];
    $course->description = $_POST['description'];
    $course->teacherId = $_POST['teacherId'];

    if (isset($_POST['courseId']) && !empty($_POST['courseId'])) {
        // Update existing course
        $course->courseId = $_POST['courseId'];
        if ($course->updateCourse()) {
            echo "<p>Course updated successfully!</p>";
        } else {
            echo "<p>Failed to update course.</p>";
        }
    } else {
        // Add new course
        if ($course->addCourse()) {
            echo "<p>Course added successfully!</p>";
        } else {
            echo "<p>Failed to add course.</p>";
        }
    }
    header("Location: ../views/admin/courses.php"); // Redirect to courses page after addition/update
    exit();
}

// Handle delete course request
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id'])) {
    $course->courseId = $_GET['id'];
    if ($course->deleteCourse()) {
        echo "<p>Course deleted successfully!</p>";
    } else {
        echo "<p>Failed to delete course.</p>";
    }
    header("Location: ../views/admin/courses.php"); // Redirect to courses page after deletion
    exit();
}

// Fetch all courses
$courses = $course->getAllCourses();
?>

<div class="container">
    <h2>Courses Managment</h2>

    <h3>Add/Edit Course</h3>
    <form method="POST" action="../../controllers/CourseController.php" class="form-inline">
        <input type="hidden" id="courseId" name="courseId">
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
        <button type="submit" class="btn btn-primary">Save Course</button>
    </form>

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
    document.getElementById('courseId').value = courseId;
    document.getElementById('courseName').value = courseName;
    document.getElementById('description').value = description;
    document.getElementById('teacherId').value = teacherId;
}
</script>

<?php include '../includes/footer.php'; ?>
