<?php
require 'db.php';
header('Content-Type: application/json');

$mesasPorSeccion = [
    "principal" => [],
    "exterior" => []
];

$result = $conn->query("SELECT id, zona_id, numero FROM mesas");

while ($row = $result->fetch_assoc()) {
    $seccion = ($row['zona_id'] == 1) ? "principal" : "exterior";
    $mesasPorSeccion[$seccion][] = [
        "id" => (int)$row['id'],
        "zona_id" => (int)$row['zona_id'],
        "numero" => $row['numero']
    ];
}

echo json_encode($mesasPorSeccion);
