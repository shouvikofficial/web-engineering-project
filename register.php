<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();

if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $name = $_POST['name'];
  $email = $_POST['email'];
  $join = date('Y-m-d');
  $expiry = date('Y-m-d', strtotime('+1 month'));

  $stmt = $pdo->prepare("INSERT INTO members (username,password,name,email,join_date,expiry_date) VALUES (?,?,?,?,?,?)");
  $stmt->execute([$username,$password,$name,$email,$join,$expiry]);
  header('Location: index.php');
  exit;
}

include 'includes/header.php';
?>
<div class="container auth-box">
  <h2>Create Member Account</h2>
  <form method="post" class="auth-form">
    <input name="username" placeholder="Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <input name="name" placeholder="Full name">
    <input name="email" type="email" placeholder="Email">
    <button class="btn">Register</button>
  </form>
</div>
<?php include 'includes/footer.php'; ?>
