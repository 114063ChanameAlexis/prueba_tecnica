<?php include 'includes/db.php'; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Tareas</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/themes/default.min.css" />
    <style>
        .table-responsive {
            overflow-x: auto;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Listado de Tareas</h1>
        <div class="d-flex justify-content-between mb-3 flex-column flex-sm-row">
            <a href="create.php" class="btn btn-primary mb-2 mb-sm-0">(+)
                Agregar Tarea</a>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Tipo</th>
                        <th>Estado</th>
                        <th>Usuario Asignado</th>
                        <th>Estado de Finalización</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'includes/functions.php';
                    $tasks = getAllTasks();
                    while ($task = $tasks->fetch_assoc()) {
                        $finalizado = ($task['TareaFinalizada'] == 1) ? 'Finalizada' : 'Sin finalizar';
                        echo "<tr>
                            <td>{$task['NombreTarea']}</td>
                            <td>{$task['Descripcion']}</td>
                            <td>{$task['TipoTarea']}</td>
                            <td>{$task['Estado']}</td>
                            <td>{$task['NombreUsuario']}</td>
                            <td>{$finalizado}</td>
                            <td>
                                <a href='edit.php?id={$task['Idtarea']}' class='btn btn-info btn-sm'>Editar</a>
                                <button class='btn btn-danger btn-sm' onclick='confirmDelete({$task['Idtarea']})'>Eliminar</button>
                            </td>
                        </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <script>
        function confirmDelete(id) {
            alertify.confirm('Confirmación', '¿Estás seguro de que deseas eliminar esta tarea?', function () {
                window.location.href = 'delete.php?id=' + id;
                alertify.success('Eliminando');
            }, function () {
                alertify.error('Cancelado');
            });
        }

        window.onload = function () {
            var message = localStorage.getItem('alertMessage');
            if (message === "Editado Correctamente") {
                alertify.success(message);
                localStorage.removeItem('alertMessage');
            } else if (message === "Se agrego nueva tarea") {
                alertify.success(message);
                localStorage.removeItem('alertMessage');
            } else if (message !== null) {
                alertify.error(message);
                localStorage.removeItem('alertMessage');
            }
        };
    </script>
</body>

</html>
