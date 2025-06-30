<?php
require_once 'db.php';
header("Content-Type: application/json");

$sql = "SELECT id, hora FROM horarios ORDER BY hora";
$result = $conn->query($sql);

$franjas = [
    'dia' => [],
    'tarde' => [],
    'noche' => []
];

while ($row = $result->fetch_assoc()) {
    $hora = $row['hora'];
    $id = $row['id'];

    $horaObj = [
        "id" => (int) $id,
        "hora" => substr($hora, 0, 5)
    ];

    $horaEntera = intval(substr($hora, 0, 2));

    if ($horaEntera >= 9 && $horaEntera < 12) {
        $franjas['dia'][] = $horaObj;
    } elseif ($horaEntera >= 12 && $horaEntera < 18) {
        $franjas['tarde'][] = $horaObj;
    } elseif ($horaEntera >= 18 && $horaEntera <= 23) {
        $franjas['noche'][] = $horaObj;
    }
}

echo json_encode($franjas);
