<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!isset($_SESSION['user']) || !is_admin()) { header('Location: index.php'); exit; }

$totalMembers = $pdo->query("SELECT COUNT(*) AS c FROM members")->fetch()['c'];
$totalPayments = $pdo->query("SELECT IFNULL(SUM(amount),0) AS s FROM payments")->fetch()['s'];
$todayCheckins = $pdo->prepare("SELECT COUNT(*) AS c FROM attendance WHERE DATE(checkin_time)=?");
$todayCheckins->execute([date('Y-m-d')]);
$todayCount = $todayCheckins->fetch()['c'];

include 'includes/header.php';
?>
<div class="container">
  <h1>Admin Dashboard</h1>
  <div class="stats-grid">
    <div class="stat"><h3>Members</h3><p><?php echo $totalMembers; ?></p></div>
    <div class="stat"><h3>Revenue</h3><p>$<?php echo number_format($totalPayments,2); ?></p></div>
    <div class="stat"><h3>Today Check-ins</h3><p><?php echo $todayCount; ?></p></div>
  </div>

  <section class="card">
    <h2>Monthly Revenue (Example)</h2>
    <canvas id="revenueChart"></canvas>
  </section>
</div>

<script>
const ctx = document.getElementById('revenueChart');
new Chart(ctx, {
  type: 'line',
  data: {
    labels: ['Jan','Feb','Mar','Apr','May','Jun'],
    datasets: [{ label: 'Revenue', data: [400,700,1000,900,1200,1600], fill:true }]
  }
});
</script>

<?php include 'includes/footer.php'; ?>
