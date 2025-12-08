<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Handle Add Trainer
$msg = "";
if (isset($_POST['add_trainer'])) {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $image = $_POST['image'];

    if (!empty($name) && !empty($specialty)) {
        $sql = "INSERT INTO trainers (name, specialty, image_url) VALUES ('$name', '$specialty', '$image')";
        $run = mysqli_query($con, $sql);
        
        if ($run) {
            $msg = "<div style='color: green; margin-bottom: 10px;'>Trainer added successfully!</div>";
        } else {
            $msg = "<div style='color: red; margin-bottom: 10px;'>Error adding trainer.</div>";
        }
    } else {
        $msg = "<div style='color: red; margin-bottom: 10px;'>Please fill in all fields.</div>";
    }
}

// Handle Update Trainer
if (isset($_POST['update_trainer'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $image = $_POST['image'];

    $sql = "UPDATE trainers SET name='$name', specialty='$specialty', image_url='$image' WHERE id='$id'";
    $run = mysqli_query($con, $sql);

    if ($run) {
        $msg = "<div style='color: green; margin-bottom: 10px;'>Trainer updated successfully!</div>";
    } else {
        $msg = "<div style='color: red; margin-bottom: 10px;'>Update failed!</div>";
    }
}

include '../includes/header.php';

// Check if editing
$edit_mode = false;
$edit_data = [];
if (isset($_GET['edit'])) {
    $edit_mode = true;
    $edit_id = $_GET['edit'];
    $sql = "SELECT * FROM trainers WHERE id='$edit_id'";
    $result = mysqli_query($con, $sql);
    $edit_data = mysqli_fetch_assoc($result);
}
?>

<h2>Manage Trainers</h2>

<?php echo $msg; ?>

<div class="form-card">
    <h3><?php echo $edit_mode ? 'Edit Trainer' : 'Add New Trainer'; ?></h3>
    <form method="POST" action="">
        <div class="form-group">
            <label>Trainer Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo $edit_mode ? $edit_data['name'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Specialty</label>
            <input type="text" name="specialty" class="form-control" value="<?php echo $edit_mode ? $edit_data['specialty'] : ''; ?>" required>
        </div>
        <div class="form-group">
            <label>Image URL</label>
            <input type="text" name="image" class="form-control" value="<?php echo $edit_mode ? $edit_data['image_url'] : ''; ?>" placeholder="https://example.com/image.jpg">
        </div>
        <?php if ($edit_mode) { ?>
            <input type="hidden" name="id" value="<?php echo $edit_data['id']; ?>">
            <button type="submit" name="update_trainer" class="btn btn-primary">Update Trainer</button>
            <a href="trainers.php" class="btn btn-secondary">Cancel</a>
        <?php } else { ?>
            <button type="submit" name="add_trainer" class="btn btn-primary">Add Trainer</button>
        <?php } ?>
    </form>
</div>

<br>

<h3>Existing Trainers</h3>
<div class="table-responsive">
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Specialty</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM trainers";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . $row['id'] . "</td>";
                    echo "<td>";
                    if (!empty($row['image_url'])) {
                        echo "<img src='" . $row['image_url'] . "' alt='Trainer' style='width: 50px; height: 50px; object-fit: cover; border-radius: 50%;'>";
                    } else {
                        echo "N/A";
                    }
                    echo "</td>";
                    echo "<td>" . $row['name'] . "</td>";
                    echo "<td>" . $row['specialty'] . "</td>";
                    echo "<td>";
                    echo "<a style='color:blue; margin-right:10px;' href='trainers.php?edit=" . $row['id'] . "'>Edit</a> | ";
                    echo "<a style='color:red;' href='delete_trainer.php?id=" . $row['id'] . "' onclick='return confirm(\"Are you sure?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5' style='text-align:center;'>No trainers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>