<?php
$titulo = 'Emprendimientos';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

<?php
$servername = "localhost";
$username = "root";
$password = ".";
$database = "db_feria_virtual_cr";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

$sql = "
    SELECT 
        c.id_usuario, 
        c.id_producto, 
        c.cantidad, 
        p.nombre_producto, 
        p.precio 
    FROM 
        tab_carrito_usuario AS c 
    JOIN 
        tab_productos AS p ON c.id_producto = p.id_producto;
";

$result = $conn->query($sql);


if ($result->num_rows > 0) {
    echo "<table border='1' style='width:100%; text-align:center;'>
            <tr>
                <th>ID Usuario</th>
                <th>Nombre del Producto</th>
                <th>Precio</th>
                <th>Cantidad</th>
            </tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>" . htmlspecialchars($row['id_usuario']) . "</td>
                <td>" . htmlspecialchars($row['nombre_producto']) . "</td>
                <td>¢" . htmlspecialchars($row['precio']) . "</td>
                <td>" . htmlspecialchars($row['cantidad']) . "</td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "No se encontraron productos en el carrito.";
}


$conn->close();
?>

<?php
$titulo = 'Emprendimientos';
require_once '../layout/footer.php';
?>
