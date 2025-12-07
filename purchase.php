<?php
session_start();
include 'backend/connection.php';

// Must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Must have a plan ID
if (!isset($_GET['plan'])) {
    header("Location: index.php");
    exit();
}

$plan_id = intval($_GET['plan']);
$plan = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pricing_plans WHERE id=$plan_id"));

if (!$plan) {
    echo "Invalid plan!";
    exit();
}

// Convert features
$features = explode(",", $plan['features']);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Purchase Plan</title>
    <style>
        .purchase-card {
            max-width: 550px;
            margin: 40px auto;
            padding: 25px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-family: Arial, sans-serif;
        }
        .purchase-card h2 {
            margin: 0 0 15px;
            text-align: center;
        }
        ul {
            padding-left: 20px;
        }
        .btn-confirm {
            width: 100%;
            padding: 12px;
            background: #0066ff;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 15px;
            font-size: 16px;
        }
        .btn-confirm:hover {
            background: #004dcc;
        }
    </style>
</head>
<body>

<div class="purchase-card">
    <h2>Confirm Your Purchase</h2>

    <h3><?php echo $plan['plan_name']; ?></h3>
    <p><strong>Price:</strong> ৳<?php echo $plan['price']; ?> / month</p>
    <p><strong>Duration:</strong> <?php echo $plan['duration_days']; ?> days</p>

    <h4>Features:</h4>
    <ul>
        <?php foreach ($features as $f): ?>
            <?php $f = trim($f); ?>
            <?php if (str_ends_with($f, ":no")): ?>
                <li style="color:#999;">❌ <?php echo str_replace(":no", "", $f); ?></li>
            <?php else: ?>
                <li>✅ <?php echo $f; ?></li>
            <?php endif; ?>
        <?php endforeach; ?>
    </ul>

    <form method="POST" action="backend/purchase_process.php">
        <input type="hidden" name="plan_id" value="<?php echo $plan['id']; ?>">
        <button type="submit" class="btn-confirm">Confirm Purchase</button>
    </form>
</div>

</body>
</html>
