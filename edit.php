<?php
require 'db.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM tasks WHERE id=?");
$stmt->execute([$id]);
$task = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$task) { die('Tarefa não encontrada.'); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $title = trim($_POST['title'] ?? '');
  $desc  = trim($_POST['description'] ?? '');
  $status = $_POST['status'] ?? 'todo';

  if ($title !== '') {
    $up = $pdo->prepare("UPDATE tasks SET title=?, description=?, status=? WHERE id=?");
    $up->execute([$title, $desc ?: null, $status, $id]);
  }
  header('Location: index.php'); exit;
}
?>
<!doctype html>
<html lang="pt"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Editar tarefa</title>
<link rel="stylesheet" href="style.css">
</head><body>
<div class="container">
  <h1>Editar tarefa</h1>
  <form method="post">
    <label>Título
      <input name="title" value="<?= htmlspecialchars($task['title']) ?>" required>
    </label>
    <label>Descrição
      <textarea name="description" rows="4"><?= htmlspecialchars($task['description']) ?></textarea>
    </label>
    <label>Status
      <select name="status">
        <option value="todo"  <?= $task['status']==='todo'?'selected':'' ?>>Por fazer</option>
        <option value="doing" <?= $task['status']==='doing'?'selected':'' ?>>A fazer</option>
        <option value="done"  <?= $task['status']==='done'?'selected':''  ?>>Feito</option>
      </select>
    </label>
    <button class="btn">Guardar</button>
    <a href="index.php">Cancelar</a>
  </form>
</div>
</body></html>
