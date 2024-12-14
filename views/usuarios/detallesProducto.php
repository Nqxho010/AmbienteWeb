<?php
require_once '../../model/db.php'; // Incluye la conexión a la base de datos
require_once '../../model/producto.php';

// Manejo de excepciones para inicializar el modelo
try {
    $productoModel = new Producto($conn); // Usa $conn definida en db.php
} catch (Exception $e) {
    die("Error al inicializar el modelo: " . $e->getMessage());
}

// Obtiene el ID del producto desde el GET
$id_producto = isset($_GET['idProducto']) && is_numeric($_GET['idProducto']) ? intval($_GET['idProducto']) : null;



if (!$id_producto) {
    die("ID de producto no válido.");
}


try {
    $producto = $productoModel->obtenerProductoPorId($id_producto);
    if (!$producto) {
        die("Producto no encontrado.");
    }
} catch (Exception $e) {
    die("Error al obtener los detalles del producto: " . $e->getMessage());
}


$titulo = 'Detalles de producto';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

<div class="producto">
    <h1 class="producto__titulo">Detalles del Producto</h1>
    <div class="producto__grupo">
        
        <img class="producto__img" 
             src="<?= htmlspecialchars($producto['url_imagen']) ?>" 
             alt="<?= htmlspecialchars($producto['nombre_producto']) ?>">
        <h2><?= htmlspecialchars($producto['nombre_producto']) ?></h2>
        <p><strong>Descripción:</strong> <?= htmlspecialchars($producto['descripcion']) ?></p>
        <p><strong>Precio:</strong> ₡<?= number_format($producto['precio'], 2) ?></p>
        <p><strong>Stock:</strong> <?= htmlspecialchars($producto['stock']) ?></p>
        <p><strong>Categoría:</strong> <?= htmlspecialchars($producto['categoria']) ?></p>
        <p><strong>Emprendimiento:</strong> <?= htmlspecialchars($producto['nombre_emprendimiento']) ?></p>
        <a href="productos.php" class="boton-verde">Volver a Productos</a>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>
