<?php
if(session_status() == PHP_SESSION_NONE) session_start();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>FitTrack Pro</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
<header class="site-header">
  <div class="container header-inner">
    <a class="logo" href="dashboard.php">FitTrack <span>Pro</span></a>
    <nav>
      <?php if(isset($_SESSION['user'])): ?>
        <a href="dashboard.php">Dashboard</a>
        <?php if(is_admin()): ?><a href="add_member.php">Add Member</a><?php endif; ?>
        <a href="view_members.php">Members</a>
        <a href="classes.php">Classes</a>
        <a href="attendance.php">Attendance</a>
        <a href="bmi.php">BMI</a>
        <a href="chat.php">Chat</a>
        <a href="logout.php">Logout</a>
      <?php else: ?>
        <a href="index.php">Login</a>
        <a href="register.php">Register</a>
      <?php endif; ?>
    </nav>
  </div>
</header>
<main>
