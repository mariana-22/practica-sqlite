<?php
$db = new SQLite3('usuarios.db');
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
if ($id > 0) {
  $stmt = $db->prepare('DELETE FROM usuarios WHERE id = :id');
  $stmt->bindValue(':id', $id, SQLITE3_INTEGER);
  $stmt->execute();
}
header('Location: usuarios.php');
exit;
?>
