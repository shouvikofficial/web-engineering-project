<?php
session_start();
include 'connection.php';

if(isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        if(password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];
            $_SESSION['email'] = $user['email'];
            
            header("Location: ../index.php");
            exit();

        } else {
            header("Location: ../login.php?error=invalid");
            exit();
        }
    } else {
        header("Location: ../login.php?error=invalid");
        exit();
    }
} else {
    header("location: ../login.php");
    exit();
}
?>
