<?php
include 'includes/functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = trim($_POST['NombreTarea']);
    $descripcion = trim($_POST['Descripcion']);
    $idtipo = trim($_POST['Idtipo_tarea']);
    $idestado = trim($_POST['Idestado']);
    $idusuario = trim($_POST['Idusuario_asignado']);

    $errors = [];
    if (empty($idtipo)) {
        $errors[] = 'Debe seleccionar un tipo de tarea.';
    }
    if (empty($idestado)) {
        $errors[] = 'Debe seleccionar un estado.';
    }
    if (empty($idusuario)) {
        $errors[] = 'Debe seleccionar un usuario.';
    }

    if (!empty($errors)) {
        $error = implode('<br>', $errors);
    } else {
        if (createTask($nombre, $descripcion, $idtipo, $idestado, $idusuario)) {
            header('Location: index.php');
            exit;
        } else {
            $error = "Error al crear la tarea";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear Tarea</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h1>Crear Tarea</h1>
        <?php if (isset($error)) {
            echo "<div class='alert alert-danger'>$error</div>";
        } ?>
        <form method="POST" action="">
            <div class="form-group">
                <label for="NombreTarea">Nombre</label>
                <input type="text" class="form-control" id="NombreTarea" name="NombreTarea" required>
            </div>
            <div class="form-group">
                <label for="Descripcion">Descripción</label>
                <textarea class="form-control" id="Descripcion" name="Descripcion" required></textarea>
            </div>
            <div class="form-group">
                <label for="Idtipo_tarea">Tipo de Tarea</label>
                <select class="form-control" id="Idtipo_tarea" name="Idtipo_tarea">
                    <option value="">Seleccione un tipo de tarea</option>
                    <?php echo getOptions('tipo_tarea', 'Idtipo_tarea', 'Descripcion'); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Idestado">Estado</label>
                <select class="form-control" id="Idestado" name="Idestado">
                    <option value="">Seleccione un estado</option>
                    <?php echo getOptions('estado', 'Idestado', 'Descripcion'); ?>
                </select>
            </div>
            <div class="form-group">
                <label for="Idusuario_asignado">Usuario Asignado</label>
                <select class="form-control" id="Idusuario_asignado" name="Idusuario_asignado">
                    <option value="">Seleccione un usuario</option>
                    <?php echo getOptions('usuario', 'Idusuario', 'NombreApellido'); ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" onclick="saveMessage()">Crear Tarea</button>
            <a href="index.php" class="btn btn-secondary"  onclick="cancelMessage()">Cancelar</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        function saveMessage() {
            var message = "Se agrego nueva tarea";
            localStorage.setItem('alertMessage', message);
        }
        function cancelMessage() {
            var message = "Cancelado";
            localStorage.setItem('alertMessage', message);
        }
    </script>
</body>

</html>