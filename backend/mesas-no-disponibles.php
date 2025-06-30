<?php
require 'db.php';
header('Content-Type: application/json');

if (!isset($_GET['fecha']) || !isset($_GET['hora'])) {
    http_response_code(400);
    echo json_encode(["error" => "Faltan los parámetros 'fecha' y/o 'hora'."]);
    exit;
}

$fecha = $_GET['fecha'];
$hora = $_GET['hora'];

$noDisponibles = [
    "principal" => [],
    "exterior" => []
];

$sql = "SELECT r.mesa_id, m.zona_id
        FROM reservas r
        JOIN mesas m ON r.mesa_id = m.id
        JOIN horarios h ON r.horario_id = h.id
        WHERE r.fecha = ? AND h.hora = ?";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode(["error" => "Error al preparar la consulta"]);
    exit;
}

$stmt->bind_param("ss", $fecha, $hora);
$stmt->execute();

$result = $stmt->get_result();

if (!$result) {
    http_response_code(500);
    echo json_encode(["error" => "Error al obtener resultados"]);
    exit;
}

while ($row = $result->fetch_assoc()) {
    $zona = ($row['zona_id'] == 1) ? "principal" : "exterior";
    $noDisponibles[$zona][] = (int)$row['mesa_id'];
}

$stmt->close();

echo json_encode($noDisponibles);