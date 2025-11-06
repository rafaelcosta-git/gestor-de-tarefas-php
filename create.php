<?php
require 'db.php';

$title = trim($_POST['title'] ?? '');
$desc  = trim($_POST['description'] ?? '');
$status = $_POST['status'] ?? 'todo';

if ($title === '') {
  header('Location: index.php'); exit;
}

$stmt = $pdo->prepare("INSERT INTO tasks (title, description, status) VALUES (?, ?, ?)");
$stmt->execute([$title, $desc ?: null, $status]);

header('Location: index.php');
