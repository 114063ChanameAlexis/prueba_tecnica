<?php
$servername = "srv1487.hstgr.io";
$username = "u487890062_root";
$password = "SYSdba2024";
$dbname = "u487890062_gestion_tareas";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>