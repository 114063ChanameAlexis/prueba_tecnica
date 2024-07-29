<?php
include 'includes/functions.php';

$id = $_GET['id'];
if (deleteTask($id)) {
    header('Location: index.php');
    exit;
} else {
    echo "Error al eliminar la tarea.";
}
?>