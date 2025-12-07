<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id']) || !isset($_GET['id'])) {
    header("Location: ../login.php");
    exit();
}

$id = intval($_GET['id']);

mysqli_query($con, "UPDATE subscriptions SET status='cancelled' WHERE id=$id");

header("Location: ../membership.php?cancel=success");
exit();
?>
