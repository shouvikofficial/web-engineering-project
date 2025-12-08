<?php

include '../../backend/connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM gym_classes WHERE id = '$id'";

$run = mysqli_query($con, $sql);

if(!$run){
    echo 'delete operation failed!';
} else{
    header("location: classes.php");
}

?>
