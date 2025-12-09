<?php
session_start();
include "connection.php";

// Must be logged in + must receive subscription ID
if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$sub_id = intval($_GET['id']);

// Check if subscription exists AND belongs to the logged-in user
$check = mysqli_query($con, "
    SELECT * FROM subscriptions 
    WHERE id = $sub_id AND user_id = $user_id LIMIT 1
");

if (mysqli_num_rows($check) === 0) {
    // Invalid or unauthorized
    header("Location: ../membership.php?error=invalid_subscription");
    exit();
}

// Cancel membership
mysqli_query($con, "
    UPDATE subscriptions 
    SET status = 'cancelled' 
    WHERE id = $sub_id AND user_id = $user_id
");

// Redirect after cancellation
header("Location: ../profile.php?tab=subscription&cancel=1");
exit();

?>
