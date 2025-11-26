<?php

    include 'connection.php';

    if(isset($_POST['register'])){
        
        $fullname = $_POST['fullname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        
        // Check if email already exists
        $check_sql = "SELECT * FROM users WHERE email = '$email'";
        $check_result = mysqli_query($con, $check_sql);
        
        if(mysqli_num_rows($check_result) > 0){
            echo "<script>alert('Email already exists!'); window.location.href='../register.html';</script>";
        } else {
            // Hash the password for security
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);
            
            $sql = "INSERT INTO users(fullname, email, phone, password) 
                    VALUES('$fullname', '$email', '$phone', '$hashed_password')";
            
            $run = mysqli_query($con, $sql);
            
            if(!$run){
                echo "<script>alert('Registration failed!'); window.location.href='../register.html';</script>";
            } else{
                echo "<script>alert('Registration successful! Please login.'); window.location.href='../login.html';</script>";
            }
        }
    } else {
        header("location: ../register.html");
    }

?>
