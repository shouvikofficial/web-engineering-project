<?php
require '../includes/db.php';
session_start();
// POST: send (JSON payload)
if($_SERVER['REQUEST_METHOD'] === 'POST'){
  $input = json_decode(file_get_contents('php://input'), true);
  $sender = intval($input['sender']);
  $receiver = intval($input['receiver']);
  $message = $input['message'] ?? '';
  if($sender && $receiver && $message){
    $stmt = $pdo->prepare("INSERT INTO messages (sender_id, receiver_id, message) VALUES (?,?,?)");
    $stmt->execute([$sender,$receiver,$message]);
    echo json_encode(['ok'=>true]);
    exit;
  }
  echo json_encode(['ok'=>false]);
  exit;
}
// GET: ?with=ID returns last messages between logged in member and with
$with = isset($_GET['with']) ? intval($_GET['with']) : 0;
$me = $_SESSION['member_id'] ?? 0;
if($with && $me){
  $stmt = $pdo->prepare("SELECT * FROM messages WHERE (sender_id=? AND receiver_id=?) OR (sender_id=? AND receiver_id=?) ORDER BY sent_at ASC");
  $stmt->execute([$me,$with,$with,$me]);
  $rows = $stmt->fetchAll();
  echo json_encode($rows);
  exit;
}
echo json_encode([]);
