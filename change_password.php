<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Change Password</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include "includes/header.php"; ?>

<div class="password-page">

    <div class="password-box">
        <h2>Change Password</h2>

        <?php if (isset($_GET['success'])) { ?>
            <p class="success-msg">Password updated successfully!</p>
        <?php } ?>

        <?php if (isset($_GET['error'])) { ?>
            <p class="error-msg"><?php echo $_GET['error']; ?></p>
        <?php } ?>

        <form action="backend/update_password.php" method="POST">

            <label for="password">Password</label>
            <input type="password" id="password" name="current_password" placeholder="Enter current password" required>

            <label for="password">Password</label>
            <input type="password" id="password" name="new_password" placeholder="Enter new password" required>

            <label for="confirm">Password</label>
            <input type="password" id="confirm" name="confirm_password" placeholder="Confirm password" required>
            <button type="submit" class="btn btn-primary full-width">Update Password</button>
        </form>

        <a href="settings.php" class="back-link">← Back to Settings</a>

    </div>

</div>

<?php include "includes/footer.php"; ?>
<script src="assets/js/script.js"></script>

</body>
</html>
