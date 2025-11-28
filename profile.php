<?php
include 'includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | DiuGym Center</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
</head>

<body>

    <!-- PROFILE PAGE -->
    <div class="profile-wrapper">

        <div class="profile-left">
            <div class="profile-card-main">

                <img src="assets/image/profile.jpg" class="profile-main-photo">

                <h2 class="profile-main-name">
                    <?php echo $_SESSION['fullname']; ?>
                </h2>

                <p class="profile-role">Gym Member</p>

                <div class="profile-basic-stats">
                    <div><strong>6+</strong><span>Months Active</span></div>
                    <div><strong>20+</strong><span>Classes Taken</span></div>
                </div>

                <hr>

                <p class="profile-username">@<?php echo strtolower(str_replace(" ", "", $_SESSION['fullname'])); ?></p>

                <a href="backend/logout.php" class="btn btn-outline danger-btn full-width">Logout</a>
            </div>
        </div>

        <div class="profile-right">
            <div class="section-title">Personal Information</div>

            <div class="info-grid">

                <div class="info-box">
                    <label>Full Name</label>
                    <input type="text" value="<?php echo $_SESSION['fullname']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Email</label>
                    <input type="text" value="<?php echo $_SESSION['email']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Phone</label>
                    <input type="text" value="<?php echo $_SESSION['phone']; ?>" readonly>
                </div>

                <div class="info-box">
                    <label>Member Since</label>
                    <input type="text" value="<?php echo date("F Y"); ?>" readonly>
                </div>

            </div>

            <div class="section-title">Account Settings</div>

            <div class="settings-box">
                <a href="#" class="settings-link">Update Information →</a>
                <a href="#" class="settings-link">Change Password →</a>
                <a href="#" class="settings-link" style="color:red;">Delete Account →</a>
            </div>

        </div>
    </div>

    <!-- FOOTER -->
    <?php include "includes/footer.php"; ?>

</body>
</html>
