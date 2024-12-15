<?php
require_once '../../model/db.php';
require_once '../../model/producto.php';

try {
    $productoModel = new Producto($conn);
} catch (Exception $e) {
    die("Error al inicializar el modelo: " . $e->getMessage());
}

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
        
        <!-- Formulario para agregar al carrito -->
        <form action="../../controller/agregarACarrito.php" method="POST">
            <input type="hidden" name="idProducto" value="<?= htmlspecialchars($id_producto) ?>">
            <label for="cantidad">Cantidad:</label>
            <input type="number" id="cantidad" name="cantidad" min="1" max="<?= htmlspecialchars($producto['stock']) ?>" required>
            <button type="submit" class="boton-verde">Agregar al Carrito</button>
        </form>
        
        <a href="productos.php" class="boton-verde">Volver a Productos</a>
    </div>
</div>

<?php
require_once '../layout/footer.php';
?>
