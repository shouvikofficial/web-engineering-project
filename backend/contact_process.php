<?php
include 'connection.php'; 
if (isset($_POST['submit_contact'])) {
    
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $sql = "INSERT INTO messages (name, email, message) VALUES ('$name', '$email', '$message')";

    if (mysqli_query($con, $sql)) {
        echo "<script>
                alert('Message sent successfully!');
                window.location.href = '../index.php';
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($con);
    }

    mysqli_close($con);
} else {
    header("Location: ../index.php");
    exit();
}
?>