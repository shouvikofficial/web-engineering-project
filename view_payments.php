<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start(); if(!is_admin()) { header('Location:index.php'); exit; }
$rows = $pdo->query("SELECT p.*, m.name as member FROM payments p LEFT JOIN members m ON p.member_id = m.id ORDER BY p.payment_date DESC")->fetchAll();
include 'includes/header.php';
?>
<div class="container">
  <h2>Payments</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Member</th><th>Amount</th><th>Date</th><th>Next Due</th><th>Method</th></tr></thead>
    <tbody>
      <?php foreach($rows as $r): ?>
        <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php echo esc($r['member']); ?></td>
          <td><?php echo $r['amount']; ?></td>
          <td><?php echo $r['payment_date']; ?></td>
          <td><?php echo $r['next_due']; ?></td>
          <td><?php echo esc($r['method']); ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include 'includes/footer.php'; ?>
