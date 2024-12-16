<?php
require_once '../../model/db.php';
require_once '../../model/pedido.php';

$titulo = 'Detalle del Pedido';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20los%20detalles");
    exit;
}

if (!isset($_GET['id'])) {
    header("Location: /AmbienteWeb/views/pedidos/pedidosActivos.php?error=Pedido%20no%20especificado");
    exit;
}

$idPedido = (int)$_GET['id'];

try {
    $pedidoModel = new Pedido($conn);

    // Obtener información del pedido
    $detallePedido = $pedidoModel->obtenerPedidoPorId($idPedido);

    if (!$detallePedido) {
        throw new Exception("No se encontró el pedido especificado.");
    }

    // Obtener los productos asociados al pedido
    $productosPedido = $pedidoModel->obtenerProductosDelPedido($idPedido);
} catch (Exception $e) {
    die("Error al cargar los detalles del pedido: " . $e->getMessage());
}
?>

<div class="detalle-pedido">
    <h1 class="detalle-pedido__titulo">Detalle del Pedido</h1>

    <div class="detalle-pedido__informacion">
        <p><strong>ID Pedido:</strong> <?= htmlspecialchars($detallePedido['id_pedido']) ?></p>
        <p><strong>Nombre del Usuario:</strong> <?= htmlspecialchars($detallePedido['nombre_usuario']) ?></p>
        <p><strong>Fecha:</strong> <?= htmlspecialchars($detallePedido['fecha']) ?></p>
        <p><strong>Estado:</strong> <?= htmlspecialchars($detallePedido['estado_pedido']) ?></p>
        <p><strong>Nombre del Emprendimiento:</strong> <?= htmlspecialchars($detallePedido['nombre_emprendimiento']) ?></p>
    </div>

    <!-- Lógica para mostrar el botón de cancelar -->
    <?php if (strtolower($detallePedido['estado_pedido']) === 'activo') : ?>
        <form action="/AmbienteWeb/controller/cancelarPedido.php" method="POST" class="detalle-pedido__accion">
            <input type="hidden" name="idPedido" value="<?= htmlspecialchars($detallePedido['id_pedido']) ?>">
            <button type="submit" class="boton-rojo">Cancelar Pedido</button>
        </form>
    <?php endif; ?>

    <h2 class="detalle-pedido__subtitulo">Productos del Pedido</h2>

    <?php if (empty($productosPedido)) : ?>
        <p>Este pedido no tiene productos asociados.</p>
    <?php else : ?>
        <table class="detalle-pedido__tabla">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $totalPedido = 0; 
                foreach ($productosPedido as $producto) :
                    $totalPedido += $producto['total']; 
                ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                        <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                        <td>₡<?= number_format($producto['precio_unitario'], 2) ?></td>
                        <td>₡<?= number_format($producto['total'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                <!-- Fila para mostrar el total del pedido -->
                <tr>
                    <td colspan="3" style="text-align: right; font-weight: bold;">Total del Pedido:</td>
                    <td style="font-weight: bold;">₡<?= number_format($totalPedido, 2) ?></td>
                </tr>
            </tbody>
        </table>
    <?php endif; ?>
</div>


<?php
require_once '../layout/footer.php';
?>
