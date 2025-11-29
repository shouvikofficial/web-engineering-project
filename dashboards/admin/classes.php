<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}

// Handle Add Class
$msg = "";
if (isset($_POST['add_class'])) {
    $class_name = $_POST['class_name'];
    $trainer_id = $_POST['trainer_id'];
    $schedule_day = $_POST['schedule_day'];
    $start_time = $_POST['start_time'];
    $end_time = $_POST['end_time'];
    $capacity = $_POST['capacity'];

    if (!empty($class_name) && !empty($schedule_day) && !empty($start_time)) {
        $stmt = mysqli_prepare($con, "INSERT INTO gym_classes (class_name, trainer_id, schedule_day, start_time, end_time, capacity) VALUES (?, ?, ?, ?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sisssi", $class_name, $trainer_id, $schedule_day, $start_time, $end_time, $capacity);
        
        if (mysqli_stmt_execute($stmt)) {
            // Success
        }
        mysqli_stmt_close($stmt);
    }
}

// Handle Delete Class
if (isset($_GET['delete_class'])) {
    $class_id = $_GET['delete_class'];
    $delete_query = "DELETE FROM gym_classes WHERE id = ?";
    $stmt = mysqli_prepare($con, $delete_query);
    mysqli_stmt_bind_param($stmt, "i", $class_id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header("Location: classes.php"); // Redirect to refresh list
    exit();
}

include '../includes/header.php';
?>

<h2>Manage Classes</h2>

<div class="form-card">
    <h3>Add New Class</h3>
    <form method="POST" action="">
        <div class="form-group">
            <label>Class Name</label>
            <input type="text" name="class_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Trainer</label>
            <select name="trainer_id" class="form-control">
                <option value="">Select Trainer</option>
                <?php
                $trainer_query = "SELECT id, name FROM trainers";
                $trainer_result = mysqli_query($con, $trainer_query);
                while ($trainer = mysqli_fetch_assoc($trainer_result)) {
                    echo "<option value='" . $trainer['id'] . "'>" . htmlspecialchars($trainer['name']) . "</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group">
            <label>Schedule Day</label>
            <select name="schedule_day" class="form-control" required>
                <option value="Monday">Monday</option>
                <option value="Tuesday">Tuesday</option>
                <option value="Wednesday">Wednesday</option>
                <option value="Thursday">Thursday</option>
                <option value="Friday">Friday</option>
                <option value="Saturday">Saturday</option>
                <option value="Sunday">Sunday</option>
            </select>
        </div>
        <div style="display: flex; gap: 15px;">
            <div class="form-group" style="flex: 1;">
                <label>Start Time</label>
                <input type="time" name="start_time" class="form-control" required>
            </div>
            <div class="form-group" style="flex: 1;">
                <label>End Time</label>
                <input type="time" name="end_time" class="form-control" required>
            </div>
        </div>
        <div class="form-group">
            <label>Capacity</label>
            <input type="number" name="capacity" class="form-control" value="20" required>
        </div>
        <button type="submit" name="add_class" class="btn btn-primary">Add Class</button>
    </form>
</div>

<br>

<h3>Existing Classes</h3>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Trainer</th>
                <th>Day</th>
                <th>Time</th>
                <th>Capacity</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT c.*, t.name as trainer_name 
                      FROM gym_classes c 
                      LEFT JOIN trainers t ON c.trainer_id = t.id 
                      ORDER BY FIELD(c.schedule_day, 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'), c.start_time";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['class_name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['trainer_name'] ?? 'No Trainer') . "</td>";
                    echo "<td>" . htmlspecialchars($row['schedule_day']) . "</td>";
                    echo "<td>" . date('h:i A', strtotime($row['start_time'])) . " - " . date('h:i A', strtotime($row['end_time'])) . "</td>";
                    echo "<td>" . htmlspecialchars($row['capacity']) . "</td>";
                    echo "<td>
                            <a href='classes.php?delete_class=" . $row['id'] . "' 
                               class='btn-danger' 
                               onclick='return confirm(\"Are you sure you want to delete this class?\");'>Delete</a>
                          </td>";
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
