<?php
session_start();
include '../../backend/connection.php';

if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

$id = $_GET['id'];

// Get the plan
$plan = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pricing_plans WHERE id = $id"));

$message = "";

// Update plan
if (isset($_POST['update_plan'])) {
    $name = $_POST['plan_name'];
    $price = $_POST['price'];
    $duration = $_POST['duration_days'];
    $features = $_POST['features'];

    $sql = "UPDATE pricing_plans 
            SET plan_name='$name', price='$price', duration_days='$duration', features='$features'
            WHERE id=$id";

    mysqli_query($con, $sql);
    header("Location: pricing_plans.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<h2>Edit Plan</h2>

<div class="edit-plan-page">
<form method="POST" class="edit-form-card">

    <label>Plan Name</label>
    <input type="text" name="plan_name" value="<?php echo $plan['plan_name']; ?>" required>

    <label>Price</label>
    <input type="number" step="0.01" name="price" value="<?php echo $plan['price']; ?>" required>

    <label>Duration (Days)</label>
    <input type="number" name="duration_days" value="<?php echo $plan['duration_days']; ?>" required>

    <label>Features</label>
    <textarea name="features" rows="3"><?php echo $plan['features']; ?></textarea>

    <button type="submit" name="update_plan" class="btn-update">Update Plan</button>
</form>
</div>


<?php include '../includes/footer.php'; ?>
