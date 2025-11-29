<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

// Delete user from DB
$sql = "DELETE FROM users WHERE id = '$user_id'";
$query = mysqli_query($con, $sql);

if ($query) {
    // Destroy session after deleting
    session_unset();
    session_destroy();

    // Redirect to homepage or login
    header("Location: ../index.php?deleted=1");
    exit();
} else {
    echo "Error deleting account!";
}
?>
