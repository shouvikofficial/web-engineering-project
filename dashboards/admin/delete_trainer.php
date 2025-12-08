<?php

include '../../backend/connection.php';

$id = $_GET['id'];

$sql = "DELETE FROM trainers WHERE id = '$id'";

$run = mysqli_query($con, $sql);

if(!$run){
    echo 'delete operation failed!';
} else{
    header("location: trainers.php");
}

?>
