<?php
$host = 'localhost';
$user = 'abdieeel';
$password = '0312';
$dbname = 'restaurante_reservas';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Opcional: establecer charset
$conn->set_charset("utf8");
?>
