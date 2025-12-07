<?php

include "connection.php";

$username =$_POST["username"];
$email =$_POST["email"];
$password =$_POST["password"];

$sql = "INSERT INTO students (username, email, password) VALUES ('$username', '$email', '$password')";
$run = mysqli_query($con, $sql);

if($run){
    echo "Data inserted successfully";
}else{
    echo "Failed to insert data";
}
?>