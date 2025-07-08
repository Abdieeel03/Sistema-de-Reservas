<?php
require '../backend/db.php';

if (!isset($_GET['dni'])) {
    echo "<p class='text-danger'>DNI no proporcionado.</p>";
    exit;
}

$dni = $conn->real_escape_string($_GET['dni']);
$sql = "SELECT * FROM clientes WHERE dni = '$dni'";
$result = $conn->query($sql);

if ($result && $result->num_rows > 0) {
    $cliente = $result->fetch_assoc();
} else {
    echo "<p class='text-danger'>Cliente no encontrado.</p>";
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Datos del Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header bg-dark text-white">
                <h4 class="mb-0">Datos del Cliente</h4>
            </div>
            <div class="card-body">
                <p><strong>DNI:</strong> <?= htmlspecialchars($cliente['dni']) ?></p>
                <p><strong>Nombre:</strong> <?= htmlspecialchars($cliente['nombre']) ?></p>
                <p><strong>Teléfono:</strong> <?= htmlspecialchars($cliente['telefono']) ?></p>
                <p><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></p>

                <a href="portal.php" class="btn btn-secondary mt-3">Volver al listado</a>
            </div>
        </div>
    </div>
</body>

</html>