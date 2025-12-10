<?php

    include 'connection.php';

    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO messages(name, email, message) VALUES('$name', '$email', '$message')";

    $run = mysqli_query($con, $sql);

    if(!$run){
        echo "Submission failed!";
    } else{
        header("location: ../index.php#contact");
    }

?>
