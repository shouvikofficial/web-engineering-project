<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();

if(isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check admin
  $stmt = $pdo->prepare("SELECT * FROM admin WHERE username = ?");
  $stmt->execute([$username]);
  $admin = $stmt->fetch();
  if($admin && password_verify($password, $admin['password'])) {
    $_SESSION['user'] = $admin['username'];
    $_SESSION['role'] = 'admin';
    header('Location: dashboard.php'); exit;
  }

  // Check member
  $stmt = $pdo->prepare("SELECT * FROM members WHERE username = ?");
  $stmt->execute([$username]);
  $member = $stmt->fetch();
  if($member && password_verify($password, $member['password'])) {
    $_SESSION['user'] = $member['username'];
    $_SESSION['role'] = 'member';
    $_SESSION['member_id'] = $member['id'];
    header('Location: member_dashboard.php'); exit;
  }

  $error = "Invalid credentials";
}

include 'includes/header.php';
?>
<div class="container auth-box">
  <h2>Welcome to FitTrack Pro</h2>
  <form method="post" class="auth-form">
    <input name="username" placeholder="Username" required>
    <input name="password" type="password" placeholder="Password" required>
    <button name="login" class="btn">Login</button>
    <?php if(isset($error)): ?><p class="error"><?php echo esc($error); ?></p><?php endif; ?>
  </form>
  <p>Don't have an account? <a href="register.php">Register</a></p>
</div>
<?php include 'includes/footer.php'; ?>
