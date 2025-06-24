<?php
require_once 'db.php';
header("Content-Type: application/json");

// Consultar todas las horas disponibles de la tabla "horarios"
$sql = "SELECT hora FROM horarios ORDER BY hora";
$result = $conn->query($sql);

$franjas = [
    'dia' => [],
    'tarde' => [],
    'noche' => []
];

while ($row = $result->fetch_assoc()) {
    $hora = $row['hora'];

    // Convertir "HH:MM:SS" a int para comparación
    $horaEntera = intval(substr($hora, 0, 2));

    if ($horaEntera >= 9 && $horaEntera < 12) {
        $franjas['dia'][] = substr($hora, 0, 5); // "09:00"
    } elseif ($horaEntera >= 12 && $horaEntera < 18) {
        $franjas['tarde'][] = substr($hora, 0, 5);
    } elseif ($horaEntera >= 18 && $horaEntera <= 23) {
        $franjas['noche'][] = substr($hora, 0, 5);
    }
}

echo json_encode($franjas);
