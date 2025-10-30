<?php
$db = new SQLite3('usuarios.db');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$row = null;
if ($id > 0) {
  $stmt = $db->prepare('SELECT * FROM usuarios WHERE id = :id');
  $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
  $res = $stmt->execute();
  $row = $res->fetchArray(SQLITE3_ASSOC);
}
if (!$row) {
  echo "<h2>Usuario no encontrado</h2><a href='usuarios.php'>Volver</a>";
  exit;
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <title>Editar Usuario</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="container">
    <h3>Editar Usuario</h3>
    <form action="guardar.php" method="POST" class="user-form">
      <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']) ?>">
      <div class="form-row">
        <input type="text" name="nombre" value="<?= htmlspecialchars($row['nombre']) ?>" required>
        <input type="email" name="correo" value="<?= htmlspecialchars($row['correo']) ?>" required>
      </div>
      <div>
        <button type="submit" class="btn">Guardar cambios</button>
        <a class="btn secondary" href="usuarios.php">Cancelar</a>
      </div>
    </form>
  </div>
</body>
</html>
