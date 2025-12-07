<?php
session_start();

// If no plan ID, go back
if (!isset($_GET['plan'])) {
    header("Location: index.php");
    exit();
}

$plan_id = $_GET['plan'];

// If user NOT logged in → send to register page
if (!isset($_SESSION['user_id'])) {
    header("Location: register.php?plan=" . $plan_id);
    exit();
}

// If user IS logged in → send to purchase page
header("Location: purchase.php?plan=" . $plan_id);
exit();
?>
