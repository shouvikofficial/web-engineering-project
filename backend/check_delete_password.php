<?php
session_start();
include "connection.php";

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$input_password = $_POST['password'];

// Get hashed password from database
$sql = "SELECT password FROM users WHERE id='$user_id'";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_assoc($result);

$hashed_password = $row['password'];

// Verify hash
if (password_verify($input_password, $hashed_password)) {

    // Set session flag so modal shows only once
    $_SESSION['confirm_delete'] = true;

    header("Location: ../settings.php"); 
    exit();

} else {

    header("Location: ../settings.php?error=Incorrect password!");
    exit();
}
?>
