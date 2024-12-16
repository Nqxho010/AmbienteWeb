<?php
require_once '../../model/db.php';
require_once '../../model/producto.php';

$titulo = 'Productos Deshabilitados';
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

    // Obtener productos deshabilitados del emprendimiento
    $productosDeshabilitados = $productoModel->obtenerProductosDeshabilitadosPorEmprendimiento($idEmprendimiento);
} catch (Exception $e) {
    die("Error al cargar los productos: " . $e->getMessage());
}

?>

<div class="productos-deshabilitados">
    <h1 class="productos-deshabilitados__titulo">Productos Deshabilitados</h1>

    <?php if (empty($productosDeshabilitados)) : ?>
        <p>No tienes productos deshabilitados.</p>
    <?php else : ?>
        <table class="productos-deshabilitados__tabla">
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
                <?php foreach ($productosDeshabilitados as $producto) : ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                        <td><?= htmlspecialchars($producto['descripcion']) ?></td>
                        <td>₡<?= number_format($producto['precio'], 2) ?></td>
                        <td><?= htmlspecialchars($producto['stock']) ?></td>
                        <td>
                            <form action="/AmbienteWeb/controller/rehabilitarProducto.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idProducto" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                <button type="submit" class="boton-verde">Activar</button>
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
