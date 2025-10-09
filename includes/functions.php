<?php
// includes/functions.php
function esc($v) {
  return htmlspecialchars($v ?? '', ENT_QUOTES, 'UTF-8');
}

function is_admin() {
  return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function is_member() {
  return isset($_SESSION['role']) && $_SESSION['role'] === 'member';
}

function require_login() {
  if(!isset($_SESSION['user'])) {
    header('Location: index.php');
    exit;
  }
}
