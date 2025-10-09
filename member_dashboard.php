<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!isset($_SESSION['user']) || !is_member()) { header('Location:index.php'); exit; }

$memberId = $_SESSION['member_id'];
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$memberId]);
$m = $stmt->fetch();

include 'includes/header.php';
?>
<div class="container">
  <h1>Welcome, <?php echo esc($m['name']); ?></h1>

  <div class="card">
    <p><strong>Plan:</strong> <?php echo esc($m['plan']); ?> — <strong>Points:</strong> <?php echo (int)$m['points']; ?></p>
  </div>

  <section class="card">
    <h2>Your Weight Trend</h2>
    <canvas id="weightChart"></canvas>
  </section>
</div>

<script>
new Chart(document.getElementById('weightChart'), {
  type: 'line',
  data: { labels:['W1','W2','W3','W4'], datasets:[{ label:'Weight (kg)', data:[70,69.5,69,68.5] }] }
});
</script>

<?php include 'includes/footer.php'; ?>
