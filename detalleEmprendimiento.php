<?php
$titulo = 'Detalle del Emprendimiento';
require_once './views/layout/head.php';
require_once './views/layout/header.php';
require_once './model/db.php';
require_once './model/emprendimiento.php';
require_once './model/producto.php';

// Validar que el ID de emprendimiento sea válido
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID de emprendimiento no válido.");
}

$id_emprendimiento = intval($_GET['id']);

try {
    $emprendimientoModel = new Emprendimiento($conn);
    $productoModel = new Producto($conn);

    // Obtener los detalles del emprendimiento
    $emprendimiento = $emprendimientoModel->obtenerEmprendimientoPorId($id_emprendimiento);

    if (!$emprendimiento) {
        die("El emprendimiento no existe o no está disponible.");
    }

    // Obtener los productos asociados al emprendimiento
    $productos = $productoModel->obtenerProductosPorEmprendimiento($id_emprendimiento);
} catch (Exception $e) {
    die("Error al cargar los datos: " . $e->getMessage());
}
?>

<body>
    <?php require_once './views/layout/header.php'; ?>

    <main class="detalle-emprendimiento">
        <h1 class="detalle-emprendimiento__titulo"><?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?></h1>
        <img 
            src="<?= htmlspecialchars($emprendimiento['url_imagen_perfil']) ?>" 
            alt="<?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?>" 
            class="detalle-emprendimiento__imagen"
        >
        <p><strong>Propietario:</strong> <?= htmlspecialchars($emprendimiento['nombre_propietario']) ?></p>
        <p class="detalle-emprendimiento__descripcion-corta">
            <?= nl2br(htmlspecialchars($emprendimiento['descripcion_corta'])) ?>
        </p>
        <p class="detalle-emprendimiento__descripcion-larga">
            <?= nl2br(htmlspecialchars($emprendimiento['descripcion_larga'])) ?>
        </p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($emprendimiento['telefono']) ?></p>
        <p><strong>Ubicación:</strong> <?= htmlspecialchars($emprendimiento['detalle_direccion']) ?></p>


<!--Listado de productos por emprendedor-->
        <section class="productos-emprendimiento">
            <h2>Productos del Emprendimiento</h2>
            <?php if (empty($productos)): ?>
                <p>Este emprendimiento no tiene productos asociados.</p>
            <?php else: ?>
                <ul class="productos-lista">
                    <?php foreach ($productos as $producto): ?>
                        <li class="producto-item">
                            <h3><?= htmlspecialchars($producto['nombre_producto']) ?></h3>
                            <img src="<?= htmlspecialchars($producto['url_imagen']) ?>" 
                                 alt="<?= htmlspecialchars($producto['nombre_producto']) ?>" 
                                 class="producto-imagen">
                            <p><strong>Precio:</strong> ₡<?= number_format($producto['precio'], 2) ?></p>
                            <p><strong>Stock:</strong> <?= htmlspecialchars($producto['stock']) ?></p>
                            <p><?= htmlspecialchars($producto['descripcion']) ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </section>

        <br>
        <a href="/AmbienteWeb/Index.php" class="boton-verde">Regresar</a>
    </main>

    <?php require_once './views/layout/footer.php'; ?>
</body>
</html>
