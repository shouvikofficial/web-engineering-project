<?php
session_start();
include '../../backend/connection.php';

// only admin role can access function
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    header("Location: ../../login.html");
    exit();
}
//count member
$member_query = "SELECT COUNT(*) as total FROM users WHERE role='member'"; //count total num row role with member
$member_result = mysqli_query($con, $member_query); //count match rows
$member_count = mysqli_fetch_assoc($member_result)['total'] ?? 0; //

//count trainers
$trainer_query = "SELECT COUNT(*) as total FROM trainers";
$trainer_result = mysqli_query($con, $trainer_query);
$trainer_count = mysqli_fetch_assoc($trainer_result)['total'] ?? 0;

// count total income
$income_query = "SELECT SUM(amount) as total FROM payments"; //sum of total income from our tabile
$income_result = @mysqli_query($con, $income_query); //result we get from the income-query
$total_income = 0;
if ($income_result) {
    $row = mysqli_fetch_assoc($income_result);
    $total_income = $row['total'] ?? 0;
}

include '../includes/header.php';
?>

<h2>Admin Dashboard</h2>

<div class="stats-grid">
    <div class="stat-card">
        <h3>Total Members</h3>
        <div class="value"><?php echo $member_count; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Trainers</h3>
        <div class="value"><?php echo $trainer_count; ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Income</h3>
        <div class="value">$<?php echo number_format($total_income, 2); ?></div>
    </div>
</div>

<div class="section">
    <h3>Quick Actions</h3>
    <div style="display: flex; gap: 10px;">
        <a href="members.php" class="btn btn-primary">Manage Members</a>
        <a href="trainers.php" class="btn btn-primary">Manage Trainers</a>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
