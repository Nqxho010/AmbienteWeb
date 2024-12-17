<?php
$titulo = 'Detalle del Emprendimiento';
require_once '../layout/head.php';
require_once '../layout/header.php';

require_once '../../model/db.php';
require_once '../../model/emprendimiento.php';
require_once '../../model/cliente.php';
require_once '../../model/producto.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("Error: ID de emprendimiento no especificado.");
}

$idEmprendimiento = (int)$_GET['id'];

// Instanciar modelos
$emprendimientoModel = new Emprendimiento($conn);
$clienteModel = new Cliente($conn);
$productoModel = new Producto($conn);

// Obtener detalles del emprendimiento
$emprendimiento = $emprendimientoModel->obtenerDetalleEmprendimiento($idEmprendimiento);

if (!$emprendimiento) {
    die("Error: No se encontró información sobre este emprendimiento.");
}

// Obtener información del emprendedor (usuario propietario del emprendimiento)
$idUsuarioEmprendedor = $emprendimiento['id_usuario'];
$infoEmprendedor = $clienteModel->obtenerInformacionCliente($idUsuarioEmprendedor);

// Obtener productos del emprendimiento
$productos = $productoModel->obtenerProductosPorEmprendimiento($idEmprendimiento);
?>

<div class="detalle-emprendimiento">
    <h1 class="detalle-emprendimiento__titulo"><?= htmlspecialchars($emprendimiento['nombre_emprendimiento']) ?></h1>
    <img class="detalle-emprendimiento__img" src="<?= htmlspecialchars($emprendimiento['url_imagen_perfil']) ?>" alt="Imagen del emprendimiento">

    <h2 class="detalle-emprendimiento__section-titulo">Información del Emprendedor</h2>
    <div class="detalle-emprendimiento__info-emprendedor">
        <?php if ($infoEmprendedor): ?>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($infoEmprendedor['nombre']) . ' ' . htmlspecialchars($infoEmprendedor['apellidos']) ?></p>
            <p><strong>Provincia:</strong> <?= htmlspecialchars($infoEmprendedor['provincia']) ?></p>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($infoEmprendedor['detalle_direccion']) ?></p>
        <?php else: ?>
            <p>No se encontró información del emprendedor.</p>
        <?php endif; ?>
    </div>

    <h2 class="detalle-emprendimiento__section-titulo">Información del Emprendimiento</h2>
    <div class="detalle-emprendimiento__info-emprendimiento">
        <p><strong>Descripción Corta:</strong> <?= htmlspecialchars($emprendimiento['descripcion_corta']) ?></p>
        <p><strong>Descripción Larga:</strong> <?= htmlspecialchars($emprendimiento['descripcion_larga']) ?></p>
        <p><strong>Teléfono:</strong> <?= htmlspecialchars($emprendimiento['telefono']) ?></p>
        <p><strong>Dirección:</strong> <?= htmlspecialchars($emprendimiento['detalle_direccion']) ?></p>
    </div>

    <h2 class="detalle-emprendimiento__section-titulo">Productos del Emprendimiento</h2>
    <?php if (!empty($productos)): ?>
        <div class="detalle-emprendimiento__productos">
            <?php foreach ($productos as $prod): ?>
                <div class="detalle-emprendimiento__producto">
                    <img src="<?= htmlspecialchars($prod['url_imagen']) ?>" alt="Producto">
                    <h3><?= htmlspecialchars($prod['nombre_producto']) ?></h3>
                    <p><strong>Precio:</strong> <?= number_format($prod['precio'], 2) ?></p>
                    <p><strong>Stock:</strong> <?= (int)$prod['stock'] ?></p>
                    <p><?= htmlspecialchars($prod['descripcion']) ?></p>
                    <!-- Ajuste aquí, usar idProducto en vez de id -->
                    <a href="./detallesProducto.php?idProducto=<?= (int)$prod['id_producto'] ?>" class="boton-verde" style="margin-top: 10px;">
                        Ver Detalle
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Este emprendimiento no tiene productos disponibles.</p>
    <?php endif; ?>
</div>

<?php
require_once '../layout/footer.php';
?>
