<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$user_id = $_SESSION['user_id'];

$current = $_POST['current_password'];
$newpass = $_POST['new_password'];
$confirm = $_POST['confirm_password'];

if ($newpass !== $confirm) {
    header("Location: ../change_password.php?error=New passwords do not match");
    exit();
}


$sql = "SELECT password FROM users WHERE id='$user_id'";
$res = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($res);

if (!password_verify($current, $user['password'])) {
    header("Location: ../change_password.php?error=Current password is incorrect");
    exit();
}


$hashed = password_hash($newpass, PASSWORD_DEFAULT);


$update = "UPDATE users SET password='$hashed' WHERE id='$user_id'";
mysqli_query($con, $update);

header("Location: ../change_password.php?success=1");
exit();
?>
