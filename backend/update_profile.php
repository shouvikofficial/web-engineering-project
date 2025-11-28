<?php
session_start();

include 'connection.php';   // ✅ Correct path (same folder)

// User must be logged in
if (!isset($_SESSION['user_id'])) {
    echo "error: not_logged_in";
    exit();
}

$user_id = $_SESSION['user_id'];

// Get POST values safely
$fullname = $_POST['fullname'] ?? '';
$email    = $_POST['email'] ?? '';
$phone    = $_POST['phone'] ?? '';
$address  = $_POST['address'] ?? '';
$dob      = $_POST['dob'] ?? '';
$gender   = $_POST['gender'] ?? '';
$bio      = $_POST['bio'] ?? '';

// Update user info
$sql = "UPDATE users SET 
            fullname='$fullname',
            email='$email',
            phone='$phone',
            address='$address',
            dob='$dob',
            gender='$gender',
            bio='$bio'
        WHERE id='$user_id'";

if (mysqli_query($con, $sql)) {

    // Update session instantly so UI updates
    $_SESSION['fullname'] = $fullname;
    $_SESSION['email'] = $email;
    $_SESSION['phone'] = $phone;

    echo "success";
} 
else {
    echo "error: " . mysqli_error($con);
}
?>
