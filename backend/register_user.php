<?php
include 'connection.php';

if(isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $check);
    
    if(mysqli_num_rows($result) > 0) {
        echo "<script>alert('Email already exists!'); window.location.href='../register.html';</script>";
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(fullname, email, phone, password) VALUES('$fullname', '$email', '$phone', '$hashed')";
        
        if(mysqli_query($con, $sql)) {
            echo "<script>alert('Registration successful! Please login.'); window.location.href='../login.html';</script>";
        } else {
            echo "<script>alert('Registration failed!'); window.location.href='../register.html';</script>";
        }
    }
} else {
    header("location: ../register.html");
}
?>
