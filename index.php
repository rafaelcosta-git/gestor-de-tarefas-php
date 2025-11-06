<?php require 'db.php'; ?>
<!doctype html>
<html lang="pt"><head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<title>Gestor de Tarefas</title>
<link rel="stylesheet" href="style.css">
</head><body>
<div class="container">
  <h1>Gestor de Tarefas</h1>

  <form action="create.php" method="post" style="margin:16px 0">
    <div style="display:grid;grid-template-columns:1fr 1fr 1fr;gap:8px">
      <input name="title" placeholder="Título" required>
      <select name="status">
        <option value="todo">Por fazer</option>
        <option value="doing">A fazer</option>
        <option value="done">Feito</option>
      </select>
      <button class="btn">Adicionar</button>
    </div>
    <textarea name="description" placeholder="Descrição (opcional)" rows="2"></textarea>
  </form>

  <?php
    $stmt = $pdo->query("SELECT * FROM tasks ORDER BY created_at DESC");
    $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
  ?>

  <table>
    <thead><tr><th>Título</th><th>Status</th><th>Criada em</th><th>Ações</th></tr></thead>
    <tbody>
      <?php foreach ($tasks as $t): ?>
        <tr>
          <td><?= htmlspecialchars($t['title']) ?></td>
          <td><?= htmlspecialchars($t['status']) ?></td>
          <td><?= htmlspecialchars($t['created_at']) ?></td>
          <td class="actions">
            <a href="edit.php?id=<?= $t['id'] ?>">Editar</a>
            <a href="delete.php?id=<?= $t['id'] ?>" onclick="return confirm('Apagar esta tarefa?')">Apagar</a>
          </td>
        </tr>
      <?php endforeach; ?>
      <?php if (!$tasks): ?>
        <tr><td colspan="4">Sem tarefas ainda.</td></tr>
      <?php endif; ?>
    </tbody>
  </table>
</div>
</body></html>
