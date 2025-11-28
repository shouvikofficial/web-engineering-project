<?php

include 'includes/header.php'; 

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}


include 'backend/connection.php';  // DB connection

$user_id = $_SESSION['user_id'];

// Fetch full user record
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | DiuGym Center</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<div class="profile-page">

    <!-- LEFT SIDEBAR -->
    <div class="profile-sidebar">
        <img src="assets/image/profile.jpg" class="profile-photo">

        <h2 class="profile-name"><?php echo $user['fullname']; ?></h2>
        <p class="profile-role">Gym Member</p>

        <div class="profile-stats">
            <div><strong>6+</strong><span>Months Active</span></div>
            <div><strong>20+</strong><span>Classes Taken</span></div>
        </div>

        <p class="profile-username">@<?php echo strtolower(str_replace(" ", "", $user['fullname'])); ?></p>

        <a href="backend/logout.php" class="btn btn-outline danger-btn full-width">Logout</a>
    </div>

    <!-- RIGHT SIDE CONTENT -->
    <div class="profile-content">

        <!-- TABS -->
        <div class="profile-tabs">
            <button class="tab active" onclick="openTab('about')">About</button>
            <button class="tab" onclick="openTab('programs')">Workout Programs</button>
            <button class="tab" onclick="openTab('schedule')">Scheduling</button>
            <button class="tab" onclick="openTab('subscription')">Subscription</button>
        </div>

        <!-- ABOUT TAB -->
        <div id="about" class="tab-box active">

            <div class="profile-header-row">
                <h3 class="section-title">Personal Information</h3>
                <button class="edit-btn" onclick="enableEditing()">Edit Info</button>
            </div>

            <div class="info-grid">

                <div class="info-box">
                    <label>Full Name</label>
                    <input type="text" id="fullname" value="<?php echo $user['fullname']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Email</label>
                    <input type="text" id="email" value="<?php echo $user['email']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Phone</label>
                    <input type="text" id="phone" value="<?php echo $user['phone']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Member Since</label>
                    <input type="text"
                           value="<?php echo date('F Y', strtotime($user['created_at'])); ?>"
                           readonly disabled>
                </div>

                <div class="info-box">
                    <label>Address</label>
                    <input type="text" id="address"
       value="<?php echo !empty($user['address']) ? $user['address'] : 'Not Added'; ?>"
       readonly>

                </div>

                <div class="info-box">
                    <label>Date of Birth</label>
                    <input type="date" id="dob" value="<?php echo $user['dob']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Gender</label>
                    <select id="gender" disabled>
                        <option value="Not Added" <?php if ($user['gender']=="Not Added") echo "selected"; ?>>Not Added</option>
                        <option value="Male" <?php if ($user['gender']=="Male") echo "selected"; ?>>Male</option>
                        <option value="Female" <?php if ($user['gender']=="Female") echo "selected"; ?>>Female</option>
                        <option value="Other" <?php if ($user['gender']=="Other") echo "selected"; ?>>Other</option>
                    </select>
                </div>

                <div class="info-box full-width">
                    <label>Bio</label>
                    <textarea id="bio" rows="3" readonly><?php 
    echo !empty($user['bio']) ? $user['bio'] : 'Not Added'; 
?></textarea>

                </div>

            </div>

            <button class="save-btn" id="saveBtn" onclick="saveProfile()">Save Changes</button>
        </div>

        <!-- OTHER TABS -->
        <div id="programs" class="tab-box">
            <h3 class="section-title">Workout Programs</h3>
            <p>No programs added yet.</p>
        </div>

        <div id="schedule" class="tab-box">
            <h3 class="section-title">My Class Schedule</h3>
            <p>Your schedule will appear here.</p>
        </div>

        <div id="subscription" class="tab-box">
            <h3 class="section-title">Subscription Details</h3>
            <div class="subscription-box">
                <p><strong>Current Plan:</strong> Premium</p>
                <p><strong>Price:</strong> ৳6500 / month</p>
                <p><strong>Valid Until:</strong> February 25, 2025</p>
                <a href="#" class="btn btn-primary">Upgrade / Renew</a>
            </div>
        </div>

    </div>
</div>

<?php include "includes/footer.php"; ?>
<script src="assets/js/script.js"></script>

</body>
</html>
