<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

include "backend/connection.php";

$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE id='$user_id'";
$result = mysqli_query($con, $sql);
$user = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings | DiuGym Center</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>

<?php include "includes/header.php"; ?>

<div class="settings-container">

    <!-- LEFT SIDEBAR -->
    <div class="settings-sidebar">
        <h3>Settings</h3>

        <a href="#" class="settings-side-link active" onclick="showPanel('security')">Security</a>
        <a href="#" class="settings-side-link" onclick="showPanel('privacy')">Privacy</a>
        <a href="#" class="settings-side-link" onclick="showPanel('notifications')">Notifications</a>
        <a href="#" class="settings-side-link" onclick="showPanel('appearance')">Appearance</a>
        <a href="#" class="settings-side-link danger" onclick="showPanel('deletePanel')">Delete Account</a>
    </div>

    <!-- SECURITY PANEL -->
    <div class="settings-panel" id="security" style="display:block;">
        <h2 class="settings-title">Security Settings</h2>
        <p class="settings-subtitle">Manage password, login history, and security access.</p>

        <div class="security-item">
            <label>Change Password</label>
            <button class="settings-action-btn" onclick="window.location.href='change_password.php'">Update Password</button>
        </div>

        <div class="security-item">
            <label>Two-Factor Authentication (2FA)</label>
            <button class="settings-action-btn">Enable 2FA</button>
        </div>

        <div class="security-item">
            <label>Active Sessions</label>
            <button class="settings-action-btn">View Devices</button>
        </div>
    </div>

    <!-- PRIVACY -->
    <div class="settings-panel" id="privacy">
        <h2 class="settings-title">Privacy Settings</h2>
        <p class="settings-subtitle">Control how your data is used and shown.</p>

        <div class="switch-row">
            <span>Show Email Publicly</span>
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>

        <div class="switch-row">
            <span>Show Profile to Members Only</span>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider round"></span>
            </label>
        </div>
    </div>

    <!-- NOTIFICATIONS -->
    <div class="settings-panel" id="notifications">
        <h2 class="settings-title">Notifications</h2>
        <p class="settings-subtitle">Choose how you want to receive alerts.</p>

        <div class="switch-row">
            <span>Email Notifications</span>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider round"></span>
            </label>
        </div>

        <div class="switch-row">
            <span>SMS Notifications</span>
            <label class="switch">
                <input type="checkbox">
                <span class="slider round"></span>
            </label>
        </div>

        <div class="switch-row">
            <span>Gym Class Reminders</span>
            <label class="switch">
                <input type="checkbox" checked>
                <span class="slider round"></span>
            </label>
        </div>
    </div>

    <!-- APPEARANCE -->
    <div class="settings-panel" id="appearance">
        <h2 class="settings-title">Appearance</h2>
        <p class="settings-subtitle">Switch between light & dark mode.</p>

        <div class="theme-box">
            <button class="theme-btn">Light Mode</button>
            <button class="theme-btn">Dark Mode</button>
        </div>
    </div>

    <!-- DELETE ACCOUNT PANEL -->
    <div class="settings-panel" id="deletePanel">
        <h2 class="settings-title delete-title">Delete Account</h2>
        <p class="settings-subtitle">For security reasons, please enter your password to continue.</p>

        <form action="backend/check_delete_password.php" method="POST">
            <label class="delete-label">Password</label>
            <input type="password" name="password" class="delete-input" required>

            <button type="submit" class="delete-continue-btn">Continue</button>

            <?php
            if (isset($_GET['error'])) {
                echo "<p style='color:red; margin-top:10px; font-size:14px;'>".$_GET['error']."</p>";
            }
            ?>
        </form>
    </div>

</div>

<!-- CONFIRM DELETE MODAL -->
<div id="overlay" class="overlay"></div>

<div id="deleteModal" class="delete-modal">
    <h3>Delete Account?</h3>
    <p>This action is permanent. Your profile, data and history will be permanently removed.</p>

    <div class="modal-buttons">
        <form action="backend/delete_account.php" method="POST">
            <button type="submit" class="btn-delete">Yes, Delete</button>
        </form>
        <button class="btn-cancel" id="cancelDelete">Cancel</button>
    </div>
</div>

<script>
function showPanel(id) {
    document.querySelectorAll(".settings-panel").forEach(p => p.style.display = "none");
    document.getElementById(id).style.display = "block";

    document.querySelectorAll(".settings-side-link").forEach(a => a.classList.remove("active"));
    event.target.classList.add("active");
}

// Safe cancel button (prevents JS crash)
let cancelBtn = document.getElementById("cancelDelete");
if (cancelBtn) {
    cancelBtn.onclick = function () {
        document.getElementById("overlay").style.display = "none";
        document.getElementById("deleteModal").style.display = "none";
    };
}
</script>

<?php
// Show confirmation modal ONCE after correct password
if (isset($_SESSION['confirm_delete']) && $_SESSION['confirm_delete'] === true) {
?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    showPanel('deletePanel');  
    document.getElementById("overlay").style.display = "block";
    document.getElementById("deleteModal").style.display = "block";
});
</script>
<?php
unset($_SESSION['confirm_delete']); // remove flag so reload won't show modal again
}
?>

<?php if (isset($_GET['error'])) { ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    showPanel('deletePanel');
});
</script>
<?php } ?>

<?php include "includes/footer.php"; ?>
<script src="assets/js/script.js"></script>

</body>
</html>
