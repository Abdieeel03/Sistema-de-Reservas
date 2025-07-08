<?php require '../backend/db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
        .table thead th {
            vertical-align: middle;
            text-align: center;
        }
        .table tbody td {
            vertical-align: middle;
        }
        .acciones a {
            margin-right: 6px;
        }
    </style>
</head>

<body>
    <div class="container py-5">
        <div class="card shadow-sm">
            <div class="card-header">
                <h3 class="mb-0">Listado de Reservas</h3>
            </div>

            <div class="card-body">
                <!-- Búsqueda -->
                <form method="GET" class="row gy-2 gx-3 align-items-center mb-4">
                    <div class="col-sm-4">
                        <input type="text" name="buscar_dni" class="form-control" placeholder="Buscar por DNI"
                               value="<?= isset($_GET['buscar_dni']) ? htmlspecialchars($_GET['buscar_dni']) : '' ?>">
                    </div>
                    <div class="col-auto">
                        <button type="submit" class="btn btn-dark">Buscar</button>
                        <a href="index.php" class="btn btn-secondary">Limpiar</a>
                    </div>
                </form>

                <!-- Tabla -->
                <div class="table-responsive">
                    <table class="table table-striped table-bordered align-middle text-center">
                        <thead class="table-dark">
                            <tr>
                                <th>DNI Cliente</th>
                                <th>Nombre Cliente</th>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Mesa</th>
                                <th>Zona</th>
                                <th>Personas</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $filtro = "";
                            if (isset($_GET['buscar_dni']) && !empty(trim($_GET['buscar_dni']))) {
                                $buscar_dni = $conn->real_escape_string(trim($_GET['buscar_dni']));
                                $filtro = "WHERE r.dni_cliente LIKE '%$buscar_dni%'";
                            }

                            $sql = "SELECT r.id, r.dni_cliente, c.nombre AS nombre, r.fecha, h.hora, m.numero AS numero_mesa, r.zona_id, r.num_personas
                                    FROM reservas r
                                    JOIN horarios h ON r.horario_id = h.id
                                    JOIN mesas m ON r.mesa_id = m.id
                                    JOIN clientes c ON r.dni_cliente = c.dni
                                    $filtro
                                    ORDER BY r.fecha DESC, h.hora ASC";

                            $result = $conn->query($sql);

                            if ($result->num_rows > 0):
                                while ($row = $result->fetch_assoc()):
                            ?>
                                <tr>
                                    <td><?= htmlspecialchars($row['dni_cliente']) ?></td>
                                    <td><?= htmlspecialchars($row['nombre']) ?></td>
                                    <td><?= htmlspecialchars($row['fecha']) ?></td>
                                    <td><?= htmlspecialchars($row['hora']) ?></td>
                                    <td><?= htmlspecialchars($row['numero_mesa']) ?></td>
                                    <td><?= $row['zona_id'] == 1 ? 'Principal' : 'Exterior' ?></td>
                                    <td><?= (int)$row['num_personas'] ?></td>
                                    <td class="acciones">
                                        <a href="cliente.php?dni=<?= urlencode($row['dni_cliente']) ?>" class="btn btn-sm btn-info">Ver Cliente</a>
                                        <a href="editar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary">Editar</a>
                                        <a href="eliminar.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('¿Eliminar esta reserva?')">Eliminar</a>
                                    </td>
                                </tr>
                            <?php
                                endwhile;
                            else:
                            ?>
                                <tr>
                                    <td colspan="7" class="text-center text-muted">No se encontraron reservas.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
