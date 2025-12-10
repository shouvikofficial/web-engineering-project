<?php
session_start();
include '../../backend/connection.php';


if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.php");
    exit();
}


if (isset($_GET['id'])) {
    $id = $_GET['id'];

    
    $delete_query = "DELETE FROM messages WHERE id = '$id'";
    mysqli_query($con, $delete_query);
}


header("Location: messages.php");
exit();
?>
