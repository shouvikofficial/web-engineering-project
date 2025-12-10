<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Handle Add Class
$msg = "";
if (isset($_POST['add_class'])) {
    $class_name = $_POST['class_name'];
    $schedule_day = $_POST['schedule_day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $capacity = $_POST['capacity'];

    if (!empty($class_name) && !empty($schedule_day)) {
        $sql = "INSERT INTO gym_classes (class_name, schedule_day, start_time, end_time, capacity) 
                VALUES ('$class_name', '$schedule_day', '$start_time', '$end_time', '$capacity')";
        $run = mysqli_query($con, $sql);
        
        if ($run) {
            $msg = "<div class='success-msg'>Class added successfully!</div>";
        } else {
            $msg = "<div class='error-msg'>Error adding class.</div>";
        }
    } else {
        $msg = "<div class='error-msg'>Please fill in all required fields.</div>";
    }
}

// Handle Update Class
if (isset($_POST['update_class'])) {
    $id = $_POST['id'];
    $class_name = $_POST['class_name'];
    $schedule_day = $_POST['schedule_day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $capacity = $_POST['capacity'];

    $sql = "UPDATE gym_classes SET class_name='$class_name', schedule_day='$schedule_day', 
            start_time='$start_time', end_time='$end_time', capacity='$capacity' WHERE id='$id'";
    $run = mysqli_query($con, $sql);

    if ($run) {
        $msg = "<div class='success-msg'>Class updated successfully!</div>";
    } else {
        $msg = "<div class='error-msg'>Update failed!</div>";
    }
}

include '../includes/header.php';

// Check if editing
$edit_mode = false;
$edit_data = [];
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $sql = "SELECT * FROM gym_classes WHERE id='$edit_id'";
    $result = mysqli_query($con, $sql);
    $edit_data = mysqli_fetch_assoc($result);
}
?>

<h2>Manage Classes</h2>

<?php echo $msg; ?>

<div class="form-card">
    <h3><?php echo $edit_mode ? 'Edit Class' : 'Add New Class'; ?></h3>
    <form method="POST" action="">
        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="class_name" class="form-control" value="<?php echo $edit_mode ? $edit_data['class_name'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Schedule Day</label>
            <input type="text" name="schedule_day" class="form-control" value="<?php echo $edit_mode ? $edit_data['schedule_day'] : ''; ?>" placeholder="e.g., Monday" required>
        </div>
        <div class="form-group">
            <label>Start Time</label>
            <input type="time" name="start_time" class="form-control" value="<?php echo $edit_mode ? $edit_data['start_time'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>End Time</label>
            <input type="time" name="end_time" class="form-control" value="<?php echo $edit_mode ? $edit_data['end_time'] : ''; ?>">
        </div>
        <div class="form-group">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" value="<?php echo $edit_mode ? $edit_data['capacity'] : '20'; ?>" placeholder="20">
        </div>
        <?php if ($edit_mode) { ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
            <button type="submit" name="update_class" class="btn btn-primary">Update Class</button>
            <a href="classes.php" class="btn btn-secondary">Cancel</a>
        <?php } else { ?>
            <button type="submit" name="add_class" class="btn btn-primary">Add Class</button>
        <?php } ?>
    </form>
</div>

<br>

<h3>Existing Classes</h3>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Class Name</th>
                <th>Day</th>
                <th>Time</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM gym_classes";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>" . $row['class_name'] . "</td>";
                    echo "<td>" . $row['schedule_day'] . "</td>";
                    echo "<td>" . $row['start_time'] . " - " . $row['end_time'] . "</td>";
                    echo "<td>" . $row['capacity'] . "</td>";
                    echo "<td>";
                    echo "<a style='color:blue; margin-right:10px;' href='classes.php?edit=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a style='color:red;' href='delete_class.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6' style='text-align:center;'>No classes found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
