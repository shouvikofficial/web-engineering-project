<?php
require 'includes/db.php';
require 'includes/functions.php';
session_start();
if(!isset($_SESSION['user'])) header('Location:index.php');

$memberId = $_GET['id'] ?? $_SESSION['member_id'] ?? 0;
$qrUrl = "http://localhost/fittrack_pro/api/attendance.php?mid=".$memberId;
include 'includes/header.php';
?>
<div class="container">
  <h2>QR Check-in</h2>
  <p>Scan this QR from your phone to check-in.</p>
  <img src="https://chart.googleapis.com/chart?cht=qr&chs=300x300&chl=<?php echo urlencode($qrUrl); ?>" alt="QR code">
  <p>Or open: <code><?php echo esc($qrUrl); ?></code></p>
</div>
<?php include 'includes/footer.php'; ?>
