<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

require 'db.php'; // Asegúrate de tener aquí tu conexión $conn

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Recibir datos del formulario
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    // Validación simple
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO contactos (nombre, email, mensaje, fecha) VALUES (?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    if (!$stmt) {
        echo json_encode(['status' => 'error', 'message' => 'Error en la preparación de la consulta.']);
        exit;
    }

    $stmt->bind_param("sss", $nombre, $email, $mensaje);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Mensaje enviado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al guardar el mensaje en la base de datos.']);
    }

    $stmt->close();
    $conn->close();
}
