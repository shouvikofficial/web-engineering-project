<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id']) || !isset($_GET['plan'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$plan_id = intval($_GET['plan']);

// 1️⃣ Fetch latest subscription for this user
$last = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT * FROM subscriptions
    WHERE user_id = $user_id
    ORDER BY id DESC LIMIT 1
"));

// 2️⃣ If the last subscription exists AND is ACTIVE → DO NOT RENEW
// Prevents multiple insert rows
if ($last && $last['status'] === "active") {
    header("Location: ../profile.php?tab=subscription&error=active_exists");
    exit();
}

// 3️⃣ Fetch plan details
$plan = mysqli_fetch_assoc(mysqli_query($con, "
    SELECT * FROM pricing_plans WHERE id = $plan_id
"));

if (!$plan) {
    die("Invalid plan selected.");
}

// 4️⃣ Renewal is allowed → Insert ONE new subscription
$start_date = date("Y-m-d");
$end_date   = date("Y-m-d", strtotime("+{$plan['duration_days']} days"));

$sql = "
INSERT INTO subscriptions (user_id, plan_id, start_date, end_date, status)
VALUES ($user_id, $plan_id, '$start_date', '$end_date', 'active')
";

mysqli_query($con, $sql);

// Redirect back to subscription tab
header("Location: ../profile.php?tab=subscription&renew=success");
exit();
?>
