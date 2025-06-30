<?php
require 'db.php';
header('Content-Type: application/json');

$input = json_decode(file_get_contents('php://input'), true);

if (!isset(
    $input['dni'],
    $input['nombre'],
    $input['telefono'],
    $input['email'],
    $input['fechaSeleccionada'],
    $input['horario_id'],
    $input['zonaSeleccionada'],
    $input['mesaSeleccionada'],
    $input['personas']
)) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan campos obligatorios."]);
    exit;
}

$dni = $input['dni'];
$nombre = $input['nombre'];
$telefono = $input['telefono'];
$email = $input['email'];

$fecha = $input['fechaSeleccionada'];
$horario_id = $input['horario_id'];
$zona_id = $input['zonaSeleccionada'];
$mesa_id = $input['mesaSeleccionada'];
$personas = $input['personas'];

$sql = "SELECT id FROM reservas WHERE fecha = ? AND horario_id = ? AND mesa_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $fecha, $horario_id, $mesa_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    echo json_encode(['status' => 'error', 'message' => 'La mesa ya está reservada en ese horario.']);
    exit;
}

$stmt = $conn->prepare("SELECT dni FROM clientes WHERE dni = ?");
$stmt->bind_param("s", $dni);
$stmt->execute();
$stmt->store_result();

if ($stmt->num_rows === 0) {
    $stmt->close();
    $stmt = $conn->prepare("INSERT INTO clientes (dni, nombre, telefono, email) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $dni, $nombre, $telefono, $email);
    if (!$stmt->execute()) {
        http_response_code(500);
        echo json_encode(["error" => "Error al insertar el cliente."]);
        exit;
    }
}
$stmt->close();

$stmt = $conn->prepare("INSERT INTO reservas (dni_cliente, fecha, horario_id, zona_id, mesa_id, num_personas) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssiiii", $dni, $fecha, $horario_id, $zona_id, $mesa_id, $personas);
if ($stmt->execute()) {
    echo json_encode(["success" => true, "message" => "Reserva registrada correctamente."]);
} else {
    http_response_code(500);
    echo json_encode(["error" => "Error al registrar la reserva."]);
}
$stmt->close();
$conn->close();
