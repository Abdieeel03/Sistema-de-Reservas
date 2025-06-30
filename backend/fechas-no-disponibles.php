<?php
require 'db.php';
header('Content-Type: application/json');

$res = $conn->query("SELECT COUNT(*) AS total_mesas FROM mesas");
$totalMesas = $res->fetch_assoc()['total_mesas'];

$res = $conn->query("SELECT COUNT(*) AS total_horas FROM horarios");
$totalHoras = $res->fetch_assoc()['total_horas'];

$capacidadMaximaPorDia = $totalMesas * $totalHoras;

$sql = "SELECT fecha
        FROM reservas
        GROUP BY fecha
        HAVING COUNT(*) >= $capacidadMaximaPorDia";

$result = $conn->query($sql);
$fechas = [];

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $fechas[] = $row['fecha'];
    }
}

echo json_encode($fechas);