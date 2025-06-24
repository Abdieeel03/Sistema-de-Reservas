<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    // Recibir datos del formulario
    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $mensaje = $_POST['mensaje'];

    // Validación simple
    if (empty($nombre) || empty($email) || empty($mensaje)) {
        echo json_encode(['status' => 'error', 'message' => 'Todos los campos son obligatorios.']);
        exit;
    }

    // Retornamos los datos recibidos en formato JSON
    echo json_encode([
        'status' => 'success',
        'nombre' => $nombre,
        'email' => $email,
        'mensaje' => $mensaje
    ]);
}
?>