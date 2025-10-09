<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!isset($_SESSION['user'])) header('Location:index.php');

$rows = $pdo->query("SELECT a.*, m.name FROM attendance a LEFT JOIN members m ON a.member_id = m.id ORDER BY a.checkin_time DESC LIMIT 200")->fetchAll();
include 'includes/header.php';
?>
<div class="container">
  <h2>Attendance Logs</h2>
  <table class="table"><thead><tr><th>ID</th><th>Member</th><th>Check-in Time</th><th>Method</th></tr></thead><tbody>
  <?php foreach($rows as $r): ?>
    <tr><td><?php echo $r['id']; ?></td><td><?php echo esc($r['name']); ?></td><td><?php echo $r['checkin_time']; ?></td><td><?php echo esc($r['method']); ?></td></tr>
  <?php endforeach; ?>
  </tbody></table>
</div>
<?php include 'includes/footer.php'; ?>
