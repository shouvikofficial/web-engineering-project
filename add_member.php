<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!is_admin()) { header('Location:index.php'); exit; }

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $name = $_POST['name'];
  $email = $_POST['email'];
  $phone = $_POST['phone'];
  $plan = $_POST['plan'];
  $trainer = $_POST['trainer'];
  $join = date('Y-m-d');
  $expiry = date('Y-m-d', strtotime('+1 month'));

  $stmt = $pdo->prepare("INSERT INTO members (username,password,name,email,phone,plan,trainer,join_date,expiry_date) VALUES (?,?,?,?,?,?,?,?,?)");
  $stmt->execute([$username,$password,$name,$email,$phone,$plan,$trainer,$join,$expiry]);
  $success = "Member added.";
}

include 'includes/header.php';
?>
<div class="container">
  <h2>Add Member</h2>
  <?php if(isset($success)) echo "<p class='success'>".esc($success)."</p>"; ?>
  <form method="post" class="form-grid">
    <input name="username" placeholder="username" required>
    <input name="password" placeholder="password" required>
    <input name="name" placeholder="Full name">
    <input name="email" placeholder="Email">
    <input name="phone" placeholder="Phone">
    <input name="plan" placeholder="Plan">
    <input name="trainer" placeholder="Trainer">
    <button class="btn">Add Member</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
