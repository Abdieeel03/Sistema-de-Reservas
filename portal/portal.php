<?php require '../backend/db.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <h2 class="mb-4">Listado de Reservas</h2>

        <!-- Barra de búsqueda -->
        <div class="row mb-3">
            <form method="GET" class="d-flex">
                <input type="text" name="buscar_dni" class="form-control me-2" placeholder="Buscar por DNI"
                    value="<?= isset($_GET['buscar_dni']) ? htmlspecialchars($_GET['buscar_dni']) : '' ?>">
                <button type="submit" class="btn btn-dark me-2">Buscar</button>
                <a href="index.php" class="btn btn-secondary">Limpiar</a>
            </form>
        </div>

        <table class="table table-bordered table-hover bg-white">
            <thead class="table-dark">
                <tr>
                    <th>DNI Cliente</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Mesa</th>
                    <th>Zona</th>
                    <th>Personas</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Filtro opcional por DNI
                $filtro = "";
                if (isset($_GET['buscar_dni']) && !empty(trim($_GET['buscar_dni']))) {
                    $buscar_dni = $conn->real_escape_string(trim($_GET['buscar_dni']));
                    $filtro = "WHERE r.dni_cliente LIKE '%$buscar_dni%'";
                }

                // Consulta con filtro y orden
                $sql = "SELECT r.id, r.dni_cliente, r.fecha, h.hora, m.numero AS numero_mesa, r.zona_id, r.num_personas
                        FROM reservas r
                        JOIN horarios h ON r.horario_id = h.id
                        JOIN mesas m ON r.mesa_id = m.id
                        $filtro
                        ORDER BY r.fecha DESC, h.hora ASC";

                $result = $conn->query($sql);

                if ($result->num_rows > 0):
                    while ($row = $result->fetch_assoc()):
                ?>
                    <tr>
                        <td><?= htmlspecialchars($row['dni_cliente']) ?></td>
                        <td><?= htmlspecialchars($row['fecha']) ?></td>
                        <td><?= htmlspecialchars($row['hora']) ?></td>
                        <td><?= htmlspecialchars($row['numero_mesa']) ?></td>
                        <td><?= $row['zona_id'] == 1 ? 'Principal' : 'Exterior' ?></td>
                        <td><?= (int)$row['num_personas'] ?></td>
                        <td>
                            <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                            <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta reserva?')">Eliminar</a>
                        </td>
                    </tr>
                <?php
                    endwhile;
                else:
                ?>
                    <tr>
                        <td colspan="7" class="text-center">No se encontraron reservas.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>

</html>