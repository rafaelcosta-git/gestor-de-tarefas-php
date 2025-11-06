<?php
require 'db.php';
$id = (int)($_GET['id'] ?? 0);
$pdo->prepare("DELETE FROM tasks WHERE id=?")->execute([$id]);
header('Location: index.php');
