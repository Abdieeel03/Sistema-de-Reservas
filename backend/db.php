<?php
$host = 'sql207.infinityfree.com';
$user = 'if0_39346298';
$password = 'marcelo031202';
$dbname = 'if0_39346298_restaurante_reservas';

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8");
