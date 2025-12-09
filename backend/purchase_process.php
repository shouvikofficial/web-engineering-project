<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

if (!isset($_POST['plan_id'])) {
    header("Location: ../index.php");
    exit();
}

$plan_id = intval($_POST['plan_id']);

// 1️⃣ Check if user already has ANY active subscription
$check = mysqli_query($con, "
    SELECT * FROM subscriptions 
    WHERE user_id = $user_id AND status = 'active'
");

if (mysqli_num_rows($check) > 0) {
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Subscription Error</title>
        <style>
            body {
                background: #f5f7fa;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
                font-family: Arial, sans-serif;
                margin: 0;
            }
            .error-box {
                background: #ffffff;
                padding: 30px;
                border-radius: 12px;
                max-width: 450px;
                width: 90%;
                text-align: center;
                box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            }
            .error-box h2 {
                color: #d9534f;
                margin-bottom: 10px;
            }
            .error-box p {
                color: #333;
                margin-bottom: 20px;
                font-size: 16px;
            }
            .btn {
                display: inline-block;
                padding: 10px 20px;
                background: #007bff;
                color: white;
                text-decoration: none;
                border-radius: 6px;
                font-size: 15px;
            }
            .btn:hover {
                background: #0056b3;
            }
        </style>
    </head>
    <body>

    <div class="error-box">
        <h2>⚠ Active Subscription Found</h2>
        <p>You already have an active membership.<br>
        Please cancel your current plan before purchasing another one.</p>

        <a href="../profile.php?tab=subscription" class="btn">Go to My Membership</a>
    </div>

    </body>
    </html>
    <?php
    exit();
}

// 2️⃣ Get plan details
$plan = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT * FROM pricing_plans WHERE id = $plan_id
"));

if (!$plan) {
    die("Invalid plan selected.");
}

$start_date = date("Y-m-d");
$end_date = date("Y-m-d", strtotime("+{$plan['duration_days']} days"));

// 3️⃣ Insert new subscription
$sql = "
INSERT INTO subscriptions (user_id, plan_id, start_date, end_date, status)
VALUES ($user_id, $plan_id, '$start_date', '$end_date', 'active')
";

if (mysqli_query($con, $sql)) {
    header("Location: ../purchase_success.php?plan=$plan_id");
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}
?>
