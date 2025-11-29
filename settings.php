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

        
        <div class="settings-sidebar">
            <h3>Settings</h3>

            <a href="#" class="settings-side-link active" onclick="showPanel('security')">Security</a>
            <a href="#" class="settings-side-link" onclick="showPanel('privacy')">Privacy</a>
            <a href="#" class="settings-side-link" onclick="showPanel('notifications')">Notifications</a>
            <a href="#" class="settings-side-link" onclick="showPanel('appearance')">Appearance</a>
            <a href="#" class="settings-side-link danger"  id="deleteBtn">Delete Account</a>
            
        </div>

       
        <div class="settings-panel" id="security" style="display:block;">
            <h2 class="settings-title">Security Settings</h2>
            <p class="settings-subtitle">Manage password, login history, and security access.</p>

            <div class="security-item">
                <label>Change Password</label>
                <button class="settings-action-btn" onclick="window.location.href='change_password.php'">Update
                    Password</button>
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

        
        <div class="settings-panel" id="appearance">
            <h2 class="settings-title">Appearance</h2>
            <p class="settings-subtitle">Switch between light & dark mode.</p>

            <div class="theme-box">
                <button class="theme-btn">Light Mode</button>
                <button class="theme-btn">Dark Mode</button>
            </div>
        </div>

    </div>

    
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
    </script>

    <script>
       
document.getElementById("deleteBtn").onclick = function () {
    document.getElementById("overlay").style.display = "block";
    document.getElementById("deleteModal").style.display = "block";
};


document.getElementById("cancelDelete").onclick = function () {
    document.getElementById("overlay").style.display = "none";
    document.getElementById("deleteModal").style.display = "none";
};

    </script>


    <?php include "includes/footer.php"; ?>
    <script src="assets/js/script.js"></script>

</body>

</html>