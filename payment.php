<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!is_admin()) { header('Location:index.php'); exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $member_id = intval($_POST['member_id']);
  $amount = floatval($_POST['amount']);
  $method = $_POST['method'];
  $next_due = $_POST['next_due'] ?: null;
  $stmt = $pdo->prepare("INSERT INTO payments (member_id, amount, payment_date, next_due, method) VALUES (?,?,?,?,?)");
  $stmt->execute([$member_id, $amount, date('Y-m-d'), $next_due, $method]);
  $success = "Payment recorded.";
}
$members = $pdo->query("SELECT id,name FROM members")->fetchAll();
include 'includes/header.php';
?>
<div class="container">
  <h2>Record Payment</h2>
  <?php if(isset($success)) echo "<p class='success'>".esc($success)."</p>"; ?>
  <form method="post" class="form-grid">
    <select name="member_id" required>
      <?php foreach($members as $m): ?><option value="<?php echo $m['id']; ?>"><?php echo esc($m['name']); ?></option><?php endforeach; ?>
    </select>
    <input name="amount" placeholder="Amount" required>
    <input name="next_due" type="date" placeholder="Next due date">
    <input name="method" placeholder="Method (cash/card)">
    <button class="btn">Save</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
