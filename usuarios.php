<?php
$db = new SQLite3('usuarios.db');
$result = $db->query('SELECT * FROM usuarios');
?>
<!doctype html>
<html lang="es">
<head>
	<meta charset="utf-8">
	<title>Lista de Usuarios</title>
	<link rel="stylesheet" href="style.css">
	<script>
		function confirmarBorrar(id){
			if(confirm('¿Eliminar este usuario?')){ window.location = 'eliminar.php?id='+id; }
		}
	</script>
</head>
<body>
  <div class="container">
	<h2>Lista de Usuarios Registrados</h2>
	<p><a class="btn" href="index.html">Nuevo usuario</a></p>
	<table class="table">
		<tr><th>ID</th><th>Nombre</th><th>Correo</th><th>Acciones</th></tr>
		<?php while ($row = $result->fetchArray(SQLITE3_ASSOC)): ?>
		<tr>
			<td><?= htmlspecialchars($row['id']) ?></td>
			<td><?= htmlspecialchars($row['nombre']) ?></td>
			<td><?= htmlspecialchars($row['correo']) ?></td>
			<td class="actions">
				<a class="btn" href="editar.php?id=<?= $row['id'] ?>">Editar</a>
				<a class="btn danger" href="#" onclick="confirmarBorrar(<?= $row['id'] ?>);return false;">Borrar</a>
			</td>
		</tr>
		<?php endwhile; ?>
	</table>
  </div>
</body>
</html>