<?php
require 'db.php';
header('Content-Type: application/json');

if (!isset($_GET['fecha'])) {
    http_response_code(400);
    echo json_encode(["error" => "Falta el parámetro 'fecha'."]);
    exit;
}

$fecha = $_GET['fecha'];

$mesasResult = $conn->query("SELECT COUNT(*) AS total FROM mesas");
$cantidadMesas = $mesasResult->fetch_assoc()['total'];

$sql = "SELECT h.hora
        FROM reservas r
        INNER JOIN horarios h ON r.horario_id = h.id
        WHERE r.fecha = ?
        GROUP BY r.horario_id
        HAVING COUNT(*) >= ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $fecha, $cantidadMesas);
$stmt->execute();
$result = $stmt->get_result();

$franjas = [
    'dia' => [],
    'tarde' => [],
    'noche' => []
];

while ($row = $result->fetch_assoc()) {
    $hora = $row['hora'];
    $horaEntera = intval(substr($hora, 0, 2));
    $soloHora = substr($hora, 0, 5);

    if ($horaEntera >= 9 && $horaEntera < 12) {
        $franjas['dia'][] = $soloHora;
    } elseif ($horaEntera >= 12 && $horaEntera < 18) {
        $franjas['tarde'][] = $soloHora;
    } elseif ($horaEntera >= 18 && $horaEntera <= 23) {
        $franjas['noche'][] = $soloHora;
    }
}

$stmt->close();

echo json_encode($franjas);
