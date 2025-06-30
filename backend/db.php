<?php
$host = 'sql207.infinityfree.com';
$user = 'if0_39346298';
$password = 'marcelo031202';
$dbname = 'if0_39346298_restaurante_reservas';

// Crear conexión
$conn = new mysqli($host, $user, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

// Opcional: establecer charset
$conn->set_charset("utf8");
?>
