<?php
session_start();
include 'backend/connection.php';

// Check login
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

if (!$sub) {
    die("No subscription found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Payment Successful | DiuGym</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            background: #f5f7fa;
            font-family: 'Inter', sans-serif;
            margin: 0;
            padding: 0;
        }

        .success-container {
            max-width: 600px;
            margin: 100px auto;
            background: #fff;
            padding: 40px;
            border-radius: 16px;
            box-shadow: 0 6px 25px rgba(0,0,0,0.08);
            text-align: center;
        }

        .success-icon {
            font-size: 60px;
            color: #4CAF50;
            margin-bottom: 10px;
        }

        h2 {
            font-size: 26px;
            margin-bottom: 8px;
        }

        .sub-text {
            color: #555;
            font-size: 15px;
            margin-bottom: 25px;
        }

        .receipt-box {
            background: #f1f5f9;
            padding: 20px;
            border-radius: 12px;
            text-align: left;
            margin-bottom: 25px;
            border-left: 4px solid #0066ff;
        }

        .receipt-box p {
            margin: 6px 0;
            font-size: 14.5px;
        }

        .btn-main {
            display: inline-block;
            background: #0066ff;
            color: #fff;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
        }

        .btn-main:hover {
            background: #0050cc;
        }

        .btn-outline {
            display: inline-block;
            margin-top: 15px;
            color: #333;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-outline:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

<div class="success-container">

    <div class="success-icon">✔️</div>

    <h2>Payment Successful!</h2>
    <p class="sub-text">
        Your membership plan has been <strong>activated</strong>.  
        Welcome to DiuGym! 💪
    </p>

    <div class="receipt-box">
        <p><strong>📦 Plan:</strong> <?= $sub['plan_name']; ?></p>
        <p><strong>💰 Price:</strong> ৳<?= number_format($sub['price']); ?></p>
        <p><strong>📅 Start Date:</strong> <?= $sub['start_date']; ?></p>
        <p><strong>⏳ Expiry Date:</strong> <?= $sub['end_date']; ?></p>
        <p><strong>⌛ Duration:</strong> <?= $sub['duration_days']; ?> days</p>
        <p><strong>🔑 Status:</strong> <?= ucfirst($sub['status']); ?></p>
    </div>

    <a href="dashboard/index.php" class="btn-main">Go to Dashboard</a>

    <br>
    <a href="membership.php" class="btn-outline">View My Membership</a>

</div>

</body>
</html>
