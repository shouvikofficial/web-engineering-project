<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id']) || !isset($_GET['plan'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$plan_id = intval($_GET['plan']);

// Fetch plan details
$plan = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pricing_plans WHERE id=$plan_id"));

$start = date("Y-m-d");
$end = date("Y-m-d", strtotime("+{$plan['duration_days']} days"));

$sql = "INSERT INTO subscriptions (user_id, plan_id, start_date, end_date, status)
        VALUES ($user_id, $plan_id, '$start', '$end', 'active')";
mysqli_query($con, $sql);

header("Location: ../purchase_success.php?renewed=1");
exit();
?>
