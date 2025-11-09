<?php
require_once __DIR__ . '/db.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $pdo = db();
  $stmt = $pdo->prepare("INSERT INTO messages (name, phone, email, message) VALUES (?,?,?,?)");
  $stmt->execute([$_POST['name'] ?? '', $_POST['phone'] ?? '', $_POST['email'] ?? '', $_POST['message'] ?? '']);
  header("Location: index.php?ok=1#contacto");
  exit;
}
header("Location: index.php#contacto");
