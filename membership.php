<?php
session_start();
include "backend/connection.php";

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Fetch latest subscription
$sql = "SELECT s.*, p.plan_name, p.price, p.duration_days 
        FROM subscriptions s
        JOIN pricing_plans p ON s.plan_id = p.id
        WHERE s.user_id = $user_id
        ORDER BY s.id DESC LIMIT 1";
        
$result = mysqli_query($con, $sql);
$sub = mysqli_fetch_assoc($result);

// Calculate remaining days
$today = date("Y-m-d");
$expiry = $sub['end_date'] ?? null;

$remaining_days = $expiry ? max(0, floor((strtotime($expiry) - strtotime($today)) / 86400)) : 0;
?>
<!DOCTYPE html>
<html>
<head>
    <title>My Membership</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f4f6f9;
            font-family: "Inter", sans-serif;
            padding: 40px;
        }
        .membership-card {
            max-width: 650px;
            margin: auto;
            background: white;
            padding: 30px;
            border-radius: 14px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        h2 {
            text-align: center;
            margin-bottom: 25px;
        }
        .info-box {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 10px;
            border-left: 4px solid #0066ff;
            margin-bottom: 25px;
        }
        p { margin: 8px 0; }

        .btn {
            display: inline-block;
            padding: 12px 20px;
            border-radius: 8px;
            font-weight: 600;
            text-decoration: none;
            margin-right: 10px;
        }
        .btn-dashboard {
            background: #0066ff;
            color: white;
        }
        .btn-cancel {
            background: #e11d48;
            color: white;
        }
        .btn-renew {
            background: #16a34a;
            color: white;
        }
    </style>
</head>

<body>

<div class="membership-card">
    <h2>My Membership</h2>

    <?php if (!$sub) { ?>
        <p>No active membership.</p>
        <a href="index.php#pricing" class="btn btn-renew">Buy a Plan</a>

    <?php } else { ?>

    <div class="info-box">
        <p><strong>Plan:</strong> <?= $sub['plan_name']; ?></p>
        <p><strong>Price:</strong> ৳<?= number_format($sub['price']); ?></p>
        <p><strong>Start Date:</strong> <?= $sub['start_date']; ?></p>
        <p><strong>Expiry Date:</strong> <?= $sub['end_date']; ?></p>
        <p><strong>Status:</strong> <?= ucfirst($sub['status']); ?></p>
        <p><strong>Remaining Days:</strong> <?= $remaining_days ?> days</p>
    </div>

    <a href="dashboard/index.php" class="btn btn-dashboard">Go to Dashboard</a>

    <?php if ($sub['status'] === "active") { ?>
        <a href="backend/cancel_membership.php?id=<?= $sub['id'] ?>" 
           class="btn btn-cancel"
           onclick="return confirm('Are you sure you want to cancel your membership?');">
           Cancel Membership
        </a>
    <?php } ?>

    <a href="backend/renew_membership.php?plan=<?= $sub['plan_id'] ?>" 
       class="btn btn-renew">
       Renew Membership
    </a>

    <?php } ?>
</div>

</body>
</html>
