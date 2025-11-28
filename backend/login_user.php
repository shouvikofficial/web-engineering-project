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
            
            echo "<script>alert('Login successful!'); window.location.href='../index.html';</script>";
        } else {
            echo "<script>alert('Invalid email or password!'); window.location.href='../login.html';</script>";
        }
    } else {
        echo "<script>alert('Invalid email or password!'); window.location.href='../login.html';</script>";
    }
} else {
    header("location: ../login.html");
}
?>
