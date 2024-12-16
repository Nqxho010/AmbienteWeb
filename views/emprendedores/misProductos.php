<?php
require_once '../../model/db.php';
require_once '../../model/producto.php';

$titulo = 'Mis Productos';
require_once '../layout/head.php';
require_once '../layout/header.php';

// Verificación de sesión
if (!isset($_SESSION['idUsuario']) || !isset($_SESSION['idEmprendimiento'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión");
    exit;
}

$idEmprendimiento = $_SESSION['idEmprendimiento'];

try {
    $productoModel = new Producto($conn);

    // Obtener productos del emprendimiento
    $productos = $productoModel->obtenerProductosPorEmprendimiento($idEmprendimiento);
} catch (Exception $e) {
    die("Error al cargar los productos: " . $e->getMessage());
}

?>

<div class="productos">
    <h1 class="productos__titulo">Mis Productos</h1>

    <div class="productos__acciones">
        <a href="/AmbienteWeb/views/emprendedores/crearProducto.php" class="boton-verde">Crear Producto</a>
        <a href="/AmbienteWeb/views/emprendedores/misProductosDeshabilitados.php" class="boton-verde">Ver productos deshabilitados</a>
    </div>

    <?php if (empty($productos)) : ?>
        <p style="margin-top: 20px;">No tienes productos registrados.</p>
    <?php else : ?>
        <table class="productos__tabla" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto) : ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                        <td>₡<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= htmlspecialchars($producto['stock']) ?></td>
                        <td>
                            <a href="/AmbienteWeb/views/emprendedores/miPedidoDetalle.php?id=<?= htmlspecialchars($producto['id_producto']) ?>" class="boton-verde">Ver Detalles</a>
                            <form action="/AmbienteWeb/controller/deshabilitarProducto.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idProducto" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                <button type="submit" class="boton-rojo">Deshabilitar</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once '../layout/footer.php';
?>
