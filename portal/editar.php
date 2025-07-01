<?php
require 'db.php';

$id = $_GET['id'] ?? null;

if ($_SERVER["REQUEST_METHOD"] === 'POST') {
    $personas = $_POST['num_personas'];

    $stmt = $conn->prepare("UPDATE reservas SET num_personas = ? WHERE id = ?");
    $stmt->bind_param("ii", $personas, $id);
    $stmt->execute();
    header("Location: portal.php");
    exit;
}

$res = $conn->query("SELECT * FROM reservas WHERE id = $id");
$reserva = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Editar Reserva</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h3>Editar Reserva ID <?= $id ?></h3>
        <form method="POST">
            <div class="mb-3">
                <label for="num_personas" class="form-label">Cantidad de Personas</label>
                <input type="number" name="num_personas" id="num_personas" class="form-control"
                    value="<?= $reserva['num_personas'] ?>" required min="1" max="6">
            </div>
            <button type="submit" class="btn btn-success">Guardar Cambios</button>
            <a href="index.php" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
</body>

</html>