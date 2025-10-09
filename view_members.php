<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start(); // allow admin or member to view (admin full list)
$members = $pdo->query("SELECT * FROM members ORDER BY id DESC")->fetchAll();
include 'includes/header.php';
?>
<div class="container">
  <h2>Members</h2>
  <table class="table">
    <thead><tr><th>ID</th><th>Name</th><th>Email</th><th>Phone</th><th>Plan</th><th>Points</th><th>Action</th></tr></thead>
    <tbody>
      <?php foreach($members as $r): ?>
        <tr>
          <td><?php echo $r['id']; ?></td>
          <td><?php echo esc($r['name']); ?></td>
          <td><?php echo esc($r['email']); ?></td>
          <td><?php echo esc($r['phone']); ?></td>
          <td><?php echo esc($r['plan']); ?></td>
          <td><?php echo (int)$r['points']; ?></td>
          <td><a href="edit_member.php?id=<?php echo $r['id']; ?>">Edit</a></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</div>
<?php include 'includes/footer.php'; ?>
