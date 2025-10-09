<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!is_admin()) { header('Location:index.php'); exit; }
$id = intval($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM members WHERE id = ?");
$stmt->execute([$id]);
$mem = $stmt->fetch();
if(!$mem) { header('Location:view_members.php'); exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $name = $_POST['name']; $email = $_POST['email']; $phone = $_POST['phone']; $plan = $_POST['plan']; $trainer = $_POST['trainer'];
  $stmt2 = $pdo->prepare("UPDATE members SET name=?, email=?, phone=?, plan=?, trainer=? WHERE id=?");
  $stmt2->execute([$name,$email,$phone,$plan,$trainer,$id]);
  $success = "Updated.";
  // reload updated data
  $stmt->execute([$id]); $mem = $stmt->fetch();
}

include 'includes/header.php';
?>
<div class="container">
  <h2>Edit Member</h2>
  <?php if(isset($success)) echo "<p class='success'>".esc($success)."</p>"; ?>
  <form method="post" class="form-grid">
    <input name="name" value="<?php echo esc($mem['name']); ?>">
    <input name="email" value="<?php echo esc($mem['email']); ?>">
    <input name="phone" value="<?php echo esc($mem['phone']); ?>">
    <input name="plan" value="<?php echo esc($mem['plan']); ?>">
    <input name="trainer" value="<?php echo esc($mem['trainer']); ?>">
    <button class="btn">Save</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
