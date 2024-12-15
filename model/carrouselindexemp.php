<?php
include("db.php");
// carrousel index emprendedor logica
// Consultar los datos de emprendimientos
$sql = "SELECT nombre_emprendimiento, descripcion_corta, url_imagen_perfil FROM tab_emprendimientos";
$result = $conn->query($sql);

// Generar el HTML del carrusel dinámicamente
if ($result->num_rows > 0) {
    echo '<div class="carousel-container-emp">'; // Inicio del contenedor del carrusel
    while ($row = $result->fetch_assoc()) {
        echo '<div class="item-carouserl-emp">';
        echo '<img src="' . htmlspecialchars($row["url_imagen_perfil"]) . '" alt="Imagen de ' . htmlspecialchars($row["url_imagen_perfil"]) . '" class="carousel-img">';
        echo '<h3>' . htmlspecialchars($row["nombre_emprendimiento"]) . '</h3>';
        echo '<p>' . htmlspecialchars($row["descripcion_corta"]) . '</p>';
        echo '</div>';
    }
    echo '</div>'; // Fin del contenedor del carrusel
} else {
    echo "<p>No hay emprendimientos disponibles.</p>";
}

$conn->close();
?>