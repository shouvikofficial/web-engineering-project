<?php
session_start();
include '../../backend/connection.php';

// Only admin access
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}

// Add plan
$message = "";
if (isset($_POST['add_plan'])) {
    $name = $_POST['plan_name'];
    $price = $_POST['price'];
    $duration = $_POST['duration_days'];
    $features = $_POST['features'];

    $sql = "INSERT INTO pricing_plans (plan_name, price, duration_days, features)
            VALUES ('$name', '$price', '$duration', '$features')";

    if (mysqli_query($con, $sql)) {
        $message = "<p style='color:green;'>Plan added successfully!</p>";
    } else {
        $message = "<p style='color:red;'>Error adding plan.</p>";
    }
}

// Delete plan
if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    mysqli_query($con, "DELETE FROM pricing_plans WHERE id = $id");
    header("Location: pricing_plans.php");
    exit();
}
?>

<?php include '../includes/header.php'; ?>

<!-- ISOLATED WRAPPER (Prevents CSS Conflicts) -->
<div class="pricing-page">

<h2>Manage Pricing Plans</h2>
<?php echo $message; ?>

<!-- ADD NEW PLAN -->
<div class="form-card">
    <h3>Add New Plan</h3>
    <form method="POST">
        
        <label>Plan Name</label>
        <input type="text" name="plan_name" required>

        <label>Price (BDT)</label>
        <input type="number" name="price" step="0.01" required>

        <label>Duration (Days)</label>
        <input type="number" name="duration_days" required>

        <label>Features (comma separated)</label>
        <textarea name="features" rows="3"></textarea>

        <button type="submit" name="add_plan" class="btn btn-primary">Add Plan</button>
    </form>
</div>

<br>

<!-- SHOW EXISTING PLANS -->
<h3>Existing Plans</h3>
<div class="table-responsive">
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Plan Name</th>
            <th>Price</th>
            <th>Duration</th>
            <th>Features</th>
            <th>Action</th>
        </tr>
    </thead>

    <tbody>
        <?php
        $plans = mysqli_query($con, "SELECT * FROM pricing_plans");
        while ($p = mysqli_fetch_assoc($plans)) {
            echo "
                <tr>
                    <td>{$p['id']}</td>
                    <td>{$p['plan_name']}</td>
                    <td>৳{$p['price']}</td>
                    <td>{$p['duration_days']} days</td>
                    <td>{$p['features']}</td>
                    <td>
                        <a href='edit_plan.php?id={$p['id']}' class='btn-edit'>Edit</a>
                        <a href='pricing_plans.php?delete={$p['id']}' 
                           class='btn-delete'
                           onclick=\"return confirm('Are you sure you want to delete this plan?');\">
                           Delete
                        </a>
                    </td>
                </tr>
            ";
        }
        ?>
    </tbody>
</table>
</div>

</div> <!-- end pricing-page wrapper -->

<?php include '../includes/footer.php'; ?>
