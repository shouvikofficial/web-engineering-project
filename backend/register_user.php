<?php
include 'connection.php';

if (isset($_POST['register'])) {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    $check = "SELECT * FROM users WHERE email = '$email'";
    $result = mysqli_query($con, $check);

    if (mysqli_num_rows($result) > 0) {
        header("Location: ../register.php?error=email_exists");
        exit();
    } else {
        $hashed = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO users(fullname, email, phone, password) VALUES('$fullname', '$email', '$phone', '$hashed')";

        if (mysqli_query($con, $sql)) {
            header("Location: ../login.php");
            exit();
        } else {
            header("Location: ../register.php");
            exit();
        }

    }
} else {
    header("location: ../register.php");
}
?>