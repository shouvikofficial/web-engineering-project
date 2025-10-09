<?php
// api/attendance.php
require '../includes/db.php';
$mid = isset($_GET['mid']) ? intval($_GET['mid']) : 0;
if($mid){
  $stmt = $pdo->prepare("INSERT INTO attendance (member_id, checkin_time, method) VALUES (?,?,?)");
  $stmt->execute([$mid, date('Y-m-d H:i:s'), 'qr']);
  echo "Checked in for member id: $mid";
  exit;
}
echo "No member id provided";
