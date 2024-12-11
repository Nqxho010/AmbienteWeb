<?php
include("db.php");

// Consultar los datos de emprendimientos
$sql = "SELECT id_producto, nombre_producto, precio, stock, url_imagen FROM tab_productos WHERE id_emprendimiento = 1";
$result = $conn->query($sql);

// Generar el HTML de la tabla dinámicamente
if ($result->num_rows > 0) {
    echo '<table border="1" class="table-emp">'; // Inicio de la tabla
    echo '<thead>';
    echo '<tr>';
    echo '<th>Id</th>';
    echo '<th>Nombre</th>';
    echo '<th>precio</th>';
    echo '<th>stock</th>';
    echo '<th>url_imagen</th>';
    echo '</tr>';
    echo '</thead>';
    echo '<tbody>';
    while ($row = $result->fetch_assoc()) {
        //el htmlspecial chars es par motivos de seguridad para evitar cualquier tipo de inyeccion sql
        echo '<tr>';
        echo '<td>' . htmlspecialchars($row["id_producto"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["nombre_producto"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["precio"]) . '</td>';
        echo '<td>' . htmlspecialchars($row["stock"]) . '</td>';
        echo '<td><img src="' . htmlspecialchars($row["url_imagen"]) . '" alt="Imagen de ' . htmlspecialchars($row["nombre_producto"]) . '" class="table-img"></td>';
        echo '<td>';
        echo '<form action="editar.php" method="post" style="display:inline;">';
        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row["id"]) . '">';
        echo '<button type="submit">Editar</button>';
        echo '</form>';
        echo ' ';
        echo '<form action="eliminar.php" method="post" style="display:inline;">';
        echo '<input type="hidden" name="id" value="' . htmlspecialchars($row["id"]) . '">';
        echo '<button type="submit" onclick="return confirm(\'¿Estás seguro de que deseas eliminar este emprendimiento?\');">Eliminar</button>';
        echo '</form>';
        echo '</td>';
        echo '</tr>';
    }
    echo '</tbody>';
    echo '</table>'; // Fin de la tabla
} else {
    echo "<p>No hay emprendimientos disponibles.</p>";
}

$conn->close();
?>
