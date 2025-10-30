<?php
// Conectarse (o crear) la base de datos
$db = new SQLite3('usuarios.db');
// Crear la tabla si no existe
$db->exec("CREATE TABLE IF NOT EXISTS usuarios(
	id INTEGER PRIMARY KEY AUTOINCREMENT,
	nombre TEXT NOT NULL,
	correo TEXT UNIQUE NOT NULL
)");

// Obtener los datos del formulario
$nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
$correo = isset($_POST['correo']) ? trim($_POST['correo']) : '';
$id = isset($_POST['id']) ? intval($_POST['id']) : 0;

if ($nombre === '' || $correo === '') {
	echo "<h2>Faltan datos obligatorios.</h2><a href='index.html'>Volver</a>";
	exit;
}

if ($id > 0) {
	// Actualizar registro existente
	$stmt = $db->prepare('UPDATE usuarios SET nombre = :nombre, correo = :correo WHERE id = :id');
	$stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
	$stmt->bindValue(':correo', $correo, SQLITE3_TEXT);
	$stmt->bindValue(':id', $id, SQLITE3_INTEGER);
	$res = $stmt->execute();
	if ($res) {
		header('Location: usuarios.php');
		exit;
	} else {
		echo "<h2>Error al actualizar el registro (posible correo duplicado).</h2><a href='usuarios.php'>Volver</a>";
		exit;
	}
} else {
	// Insertar nuevo registro
	$stmt = $db->prepare('INSERT INTO usuarios (nombre, correo) VALUES (:nombre, :correo)');
	$stmt->bindValue(':nombre', $nombre, SQLITE3_TEXT);
	$stmt->bindValue(':correo', $correo, SQLITE3_TEXT);
	$res = $stmt->execute();
	if ($res) {
		header('Location: usuarios.php');
		exit;
	} else {
		echo "<h2>Error al guardar el registro (correo duplicado o fallo de conexión).</h2><a href='index.html'>Volver</a>";
		exit;
	}
}
?>