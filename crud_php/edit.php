<?php
include 'includes/functions.php';

$id = $_GET['id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['NombreTarea'];
    $descripcion = $_POST['Descripcion'];
    $idtipo = $_POST['Idtipo_tarea'];
    $idestado = $_POST['Idestado'];
    $idusuario = $_POST['Idusuario_asignado'];
    $activo = (int) $_POST['TareaFinalizada'];
    $fechaActual = $_POST['FechaActual'];

    if (updateTask($id, $nombre, $descripcion, $idtipo, $idestado, $idusuario, $fechaActual, $activo)) {
        header('Location: index.php');
        exit;
    } else {
        $error = "Error al actualizar la tarea";
    }
}

$task = getTaskById($id);
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Tarea</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h1>Editar Tarea</h1>
        <?php if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="NombreTarea">Nombre</label>
                <input type="text" class="form-control" id="NombreTarea" name="NombreTarea" value="<?php echo htmlspecialchars($task['NombreTarea']); ?>" required>
            </div>
            <div class="form-group">
                <label for="Descripcion">Descripción</label>
                <textarea class="form-control" id="Descripcion" name="Descripcion" required><?php echo htmlspecialchars($task['Descripcion']); ?></textarea>
            </div>
            <div class="form-group">
                <label for="Idtipo_tarea">Tipo de Tarea</label>
                <select class="form-control" id="Idtipo_tarea" name="Idtipo_tarea">

                    <?php echo getOptions('tipo_tarea', 'Idtipo_tarea', 'Descripcion',$task['Idtipo_tarea']); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Idestado">Estado</label>
                <select class="form-control" id="Idestado" name="Idestado">
                    <?php echo getOptions('estado', 'Idestado', 'Descripcion', $task['Idestado']); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Idusuario_asignado">Usuario Asignado</label>
                <select class="form-control" id="Idusuario_asignado" name="Idusuario_asignado">
                    <?php
                    echo getOptions('usuario', 'Idusuario', 'NombreApellido', $task['Idusuario_asignado']);
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="TareaFinalizada">Condición</label>
                <select id="TareaFinalizada" name="TareaFinalizada" class="form-control">
                    <option value="0">No Finalizado</option>
                    <option value="1">Finalizado</option>
                </select>
            </div>
            <input type="hidden" id="FechaActual" name="FechaActual" value="">
            <button type="submit" class="btn btn-primary" onclick="saveMessage()">Actualizar Tarea</button>
            <a href="index.php" class="btn btn-secondary" onclick="cancelMessage()">Cancelar</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            var fechaActual = new Date().toISOString().slice(0, 19).replace('T', ' ');
            document.getElementById('FechaActual').value = fechaActual;
        });

        function saveMessage() {
            var message = "Editado Correctamente";
            localStorage.setItem('alertMessage', message);
        }

        function cancelMessage() {
            var message = "Edicion Cancelada";
            localStorage.setItem('alertMessage', message);
        }
    </script>
</body>

</html>