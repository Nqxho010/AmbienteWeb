<?php
require_once '../../model/db.php'; 
require_once '../../model/producto.php';
require_once '../../model/categoria.php';
require_once '../../model/emprendimiento1C.php';

try {
    $productoModel = new Producto($conn);
    $categoriaModel = new Categoria($conn); 
} catch (Exception $e) {
    die("Error al inicializar los modelos: " . $e->getMessage());
}


$id_emprendimiento = isset($_GET['emprendimiento']) && is_numeric($_GET['emprendimiento']) ? intval($_GET['emprendimiento']) : 3;  // Id 3 de productos panaderia


try {
    $productos = $productoModel->obtenerProductosPorEmprendimiento($id_emprendimiento);
} catch (Exception $e) {
    $productos = [];
    error_log("Error al obtener productos: " . $e->getMessage());
}

$titulo = 'Productos del Emprendimiento';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

<div class="productos">
    <div class="productos__grupo">
        <?php if (!empty($productos)): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="productos__item">
                    <h4 class="productos__nombre"><?= htmlspecialchars($producto['nombre_producto']) ?></h4>
                    <img class="productos__img" 
                         src="<?= htmlspecialchars($producto['url_imagen']) ?>" 
                         alt="<?= htmlspecialchars($producto['nombre_producto']) ?>">
                    <p class="productos__detalle"><?= htmlspecialchars($producto['descripcion']) ?></p>
                    <p class="productos__precio">Precio: ₡<?= number_format($producto['precio'], 2) ?></p>
                    <a href="detallesProducto.php?idProducto=<?= htmlspecialchars($producto['id_producto']) ?>" class="boton-verde productos__boton">Ver detalles</a>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No se encontraron productos.</p>
        <?php endif; ?>
    </div>
</div>
