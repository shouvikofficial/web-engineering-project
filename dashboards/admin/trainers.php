<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}

// Handle Add Trainer
$msg = "";
if (isset($_POST['add_trainer'])) {
    $name = $_POST['name'];
    $specialty = $_POST['specialty'];
    $image = $_POST['image'];

    if (!empty($name) && !empty($specialty)) {
        $stmt = mysqli_prepare($con, "INSERT INTO trainers (name, specialty, image_url) VALUES (?, ?, ?)");
        mysqli_stmt_bind_param($stmt, "sss", $name, $specialty, $image);
        
        if (mysqli_stmt_execute($stmt)) {
            // Success
        }
        mysqli_stmt_close($stmt);
    }
}

include '../includes/header.php';
?>

<h2>Manage Trainers</h2>

<div class="form-card">
    <h3>Add New Trainer</h3>
    <form method="POST" action="">
        <div class="form-group">
            <label>Trainer Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Specialty</label>
            <input type="text" name="specialty" class="form-control" required>
        </div>
        <div class="form-group">
            <label>Image URL</label>
            <input type="text" name="image" class="form-control" placeholder="https://example.com/image.jpg">
        </div>
        <button type="submit" name="add_trainer" class="btn btn-primary">Add Trainer</button>
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
            </tr>
        </thead>
        <tbody>
            <?php
            $query = "SELECT * FROM trainers";
            $result = mysqli_query($con, $query);

            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['id']) . "</td>";
                    echo "<td>";
                    if (!empty($row['image_url'])) {
                        echo "<img src='" . htmlspecialchars($row['image_url']) . "' alt='Trainer' style='width: 50px; height: 50px; object-fit: cover; border-radius: 50%;'>";
                    } else {
                        echo "N/A";
                    }
                    echo "</td>";
                    echo "<td>" . htmlspecialchars($row['name']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['specialty']) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='4' style='text-align:center;'>No trainers found.</td></tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php include '../includes/footer.php'; ?>
