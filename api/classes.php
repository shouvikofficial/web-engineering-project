<?php
require '../includes/db.php';
$rows = $pdo->query("SELECT id, title, start_datetime AS start, end_datetime AS end FROM classes")->fetchAll();
header('Content-Type: application/json');
echo json_encode($rows);
