<?php
include 'db.php';

function getAllTasks() {
    global $conn;
    $sql = "
    SELECT
        t.Idtarea,
        t.NombreTarea,
        t.Descripcion,
        t.TareaFinalizada,
        u.NombreApellido AS NombreUsuario,
        tt.Descripcion AS TipoTarea,
        e.Descripcion AS Estado
    FROM tarea t
    JOIN usuario u ON t.Idusuario_asignado = u.Idusuario
    JOIN tipo_tarea tt ON t.Idtipo_tarea = tt.Idtipo_tarea
    JOIN estado e ON t.Idestado = e.Idestado
    ORDER BY FechaCreacion DESC;
    ";
    return $conn->query($sql);
}

function getTaskById($id) {
    global $conn;
    $sql = "SELECT * FROM tarea WHERE Idtarea = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
}

function createTask($nombre, $descripcion, $idtipo, $idestado, $idusuario) {
    global $conn;
    $sql = "INSERT INTO tarea (NombreTarea, Descripcion, Idtipo_tarea, Idestado, Idusuario_asignado) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiii", $nombre, $descripcion, $idtipo, $idestado, $idusuario);
    return $stmt->execute();
}

function updateTask($id, $nombre, $descripcion, $idtipo, $idestado, $idusuario, $fechaActual, $activo) {
    global $conn;
    $sql = "UPDATE tarea SET NombreTarea = ?, Descripcion = ?, Idtipo_tarea = ?, Idestado = ?, Idusuario_asignado = ?, FechaModificacion = ?, TareaFinalizada = ? WHERE Idtarea = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiiisii", $nombre, $descripcion, $idtipo, $idestado, $idusuario, $fechaActual, $activo, $id);
    return $stmt->execute();
}

function deleteTask($id) {
    global $conn;
    $sql = "DELETE FROM tarea WHERE Idtarea = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    return $stmt->execute();
}

function getOptions($table, $valueField, $textField, $selectedValue = null) {
    global $conn;
    $sql = "SELECT $valueField, $textField FROM $table WHERE Activo = 1";
    $result = $conn->query($sql);
    $options = '';
    while ($row = $result->fetch_assoc()) {
        $value = $row[$valueField];
        $text = $row[$textField];
        $isSelected = ($value == $selectedValue) ? 'selected' : '';
        $options .= "<option value='$value' $isSelected>$text</option>";
    }
    return $options;
}
?>