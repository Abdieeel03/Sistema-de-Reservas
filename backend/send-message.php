<?php
require 'db.php';

header('Content-Type: application/json');

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    
    $nombre = trim($_POST['nombre'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $mensaje = trim($_POST['mensaje'] ?? '');

    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

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
