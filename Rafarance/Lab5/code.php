<?php

    include 'connect.php';

    $un = $_POST["uname"];
    $pass = $_POST["pass"];

    $sql = "INSERT INTO info(username, password) VALUES('$un', '$pass')";
    
    $run = mysqli_query($con, $sql);

    if(!$run){
        echo "submission failed!";
    } else{
        echo "submission successful!"; 
    }
?>