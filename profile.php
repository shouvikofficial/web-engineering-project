<?php
session_start();

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

// Detect active tab (default: about)
$activeTab = isset($_GET['tab']) ? $_GET['tab'] : 'about';
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
    <?php include "includes/header.php"; ?>

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
                <button class="tab <?php echo ($activeTab=='about'?'active':''); ?>" onclick="openTab('about')">About</button>
                <button class="tab <?php echo ($activeTab=='programs'?'active':''); ?>" onclick="openTab('programs')">Workout Programs</button>
                <button class="tab <?php echo ($activeTab=='schedule'?'active':''); ?>" onclick="openTab('schedule')">Scheduling</button>
                <button class="tab <?php echo ($activeTab=='subscription'?'active':''); ?>" onclick="openTab('subscription')">Subscription</button>
            </div>

            <!-- ABOUT TAB -->
            <div id="about" class="tab-box <?php echo ($activeTab=='about'?'active':''); ?>">

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
                        <input type="text" value="<?php echo date('F Y', strtotime($user['created_at'])); ?>" readonly disabled>
                    </div>

                    <div class="info-box">
                        <label>Address</label>
                        <input type="text" id="address" value="<?php echo !empty($user['address']) ? $user['address'] : 'Not Added'; ?>" readonly>
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
                        <textarea id="bio" rows="3" readonly><?php echo !empty($user['bio']) ? $user['bio'] : 'Not Added'; ?></textarea>
                    </div>

                </div>

                <button class="save-btn" id="saveBtn" onclick="saveProfile()">Save Changes</button>
            </div>

            <!-- PROGRAM TAB -->
            <div id="programs" class="tab-box <?php echo ($activeTab=='programs'?'active':''); ?>">
                <h3 class="section-title">Workout Programs</h3>
                <p>No programs added yet.</p>
            </div>

            <!-- SCHEDULE TAB -->
            <div id="schedule" class="tab-box <?php echo ($activeTab=='schedule'?'active':''); ?>">
                <h3 class="section-title">My Class Schedule</h3>

                <?php
                $selected_class = "";
                if (isset($_POST['select_class'])) {
                    $selected_class = $_POST['class_id'];
                }
                ?>

                <!-- Select Class Form -->
                <form method="POST" action="?tab=schedule">
                    <label>Select a Class:</label>

                    <select name="class_id" class="schedule-select" required>
                        <option value="">-- Choose Class --</option>

                        <?php
                        $sql = "SELECT * FROM gym_classes ORDER BY class_name";
                        $result = mysqli_query($con, $sql);

                        while ($row = mysqli_fetch_assoc($result)) {
                            $is_selected = ($selected_class == $row['id']) ? "selected" : "";
                            echo "<option value='".$row['id']."' $is_selected>".$row['class_name']."</option>";
                        }
                        ?>
                    </select>

                    <br>
                    <button type="submit" name="select_class" class="schedule-btn">Show Schedule</button>
                </form>

                <br>

                <!-- Show schedule result -->
                <?php
                if (!empty($selected_class)) {

                    $s = "SELECT * FROM gym_classes WHERE id='$selected_class'";
                    $r = mysqli_query($con, $s);

                    if (mysqli_num_rows($r) > 0) {
                        $row = mysqli_fetch_assoc($r);

                        echo "<div class='schedule-result'>";
                        echo "<h4>Selected Class Schedule:</h4>";
                        echo "<p><strong>Class:</strong> ".$row['class_name']."</p>";
                        echo "<p><strong>Day:</strong> ".$row['schedule_day']."</p>";
                        echo "<p><strong>Time:</strong> ".$row['start_time']." - ".$row['end_time']."</p>";
                        echo "<p><strong>Capacity:</strong> ".$row['capacity']."</p>";
                        echo "</div>";

                    } else {
                        echo "<p>No schedule found.</p>";
                    }

                } else {
                    echo "<p>Select a class to see the schedule.</p>";
                }
                ?>

            </div>

            <!-- SUBSCRIPTION TAB -->
            <div id="subscription" class="tab-box <?php echo ($activeTab=='subscription'?'active':''); ?>">
                <h3 class="section-title">Subscription Details</h3>

                <?php
                include 'backend/connection.php';

                if (!isset($_SESSION['user_id'])) {
                    echo "<p>Please login to view your subscription.</p>";
                    exit();
                }

                $user_id = $_SESSION['user_id'];

                $query = "
                    SELECT s.*, p.plan_name, p.price, p.duration_days
                    FROM subscriptions s
                    JOIN pricing_plans p ON s.plan_id = p.id
                    WHERE s.user_id = $user_id
                    ORDER BY s.id DESC LIMIT 1
                ";

                $sub = mysqli_fetch_assoc(mysqli_query($con, $query));

                if (!$sub) {
                ?>
                    <div class="subscription-box">
                        <p><strong>No Active Membership.</strong></p>
                        <a href="index.php#pricing" class="btn btn-primary">Buy a Plan</a>
                    </div>
                <?php
                } else {

                    $today = date("Y-m-d");
                    $expiry = $sub['end_date'];
                    $remaining = max(0, floor((strtotime($expiry) - strtotime($today)) / 86400));
                ?>

                    <div class="subscription-box">
                        <p><strong>Current Plan:</strong> <?= $sub['plan_name'] ?></p>
                        <p><strong>Price:</strong> ৳<?= $sub['price'] ?></p>
                        <p><strong>Start Date:</strong> <?= $sub['start_date'] ?></p>
                        <p><strong>Valid Until:</strong> <?= $sub['end_date'] ?></p>
                        <p><strong>Remaining Days:</strong> <?= $remaining ?> days</p>

                        <p><strong>Status:</strong>
                            <span style="color: <?= $sub['status'] === 'active' ? 'green' : 'red' ?>;">
                                <?= ucfirst($sub['status']) ?>
                            </span>
                        </p>

                        <a href="backend/renew_membership.php?plan=<?= $sub['plan_id'] ?>" 
                           class="btn btn-primary">Upgrade / Renew</a>

                        <?php if ($sub['status'] === "active") { ?>
                            <a href="backend/cancel_membership.php?id=<?= $sub['id'] ?>"
                               class="btn btn-danger"
                               onclick="return confirm('Are you sure you want to cancel your membership?');">
                               Cancel Membership
                            </a>
                        <?php } ?>
                    </div>

                <?php } ?>
            </div>

        </div>
    </div>

    <?php include "includes/footer.php"; ?>
    <script src="assets/js/script.js"></script>

</body>

</html>
