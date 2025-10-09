<?php include 'db.php'; session_start(); ?>
<?php
if(isset($_POST['login'])){
  $email = $_POST['email'];
  $password = $_POST['password'];
  $sql = "SELECT * FROM users WHERE email='$email'";
  $res = $conn->query($sql);
  if($res->num_rows > 0){
    $row = $res->fetch_assoc();
    if(password_verify($password, $row['password'])){
      $_SESSION['user'] = $row;
      header("Location: dashboard.php");
    } else { $msg = "Invalid password"; }
  } else { $msg = "User not found"; }
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Login | FitTrack</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="auth-box">
    <h2>Login</h2>
    <form method="POST">
      <input type="email" name="email" placeholder="Email" required>
      <input type="password" name="password" placeholder="Password" required>
      <button name="login">Login</button>
      <?php if(!empty($msg)) echo "<p class='error'>$msg</p>"; ?>
    </form>
  </div>
</body>
</html>
