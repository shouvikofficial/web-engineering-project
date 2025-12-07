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

// 1️⃣ Check active subscription
$check = mysqli_query($con, "
    SELECT * FROM subscriptions 
    WHERE user_id = $user_id AND status = 'active'
");

if (mysqli_num_rows($check) > 0) {
    die("❌ You already have an active subscription. Cancel or wait for expiry.");
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
