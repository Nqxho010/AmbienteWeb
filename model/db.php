<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "db_feria_virtual_cr";

$conn = new mysqli($servername, $username, $password, $database);

if($conn->connect_error){
    die("Conexio fallida");
}else{
    echo"coneccion exitosa";
}
?>