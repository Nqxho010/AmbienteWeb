<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_feria_virtual_cr";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
