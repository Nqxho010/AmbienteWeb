<?php
require_once '../../model/db.php'; 
require_once '../../model/carrito.php';
require_once '../../model/cliente.php';

$titulo = 'Checkout';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20el%20checkout");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

try {
    // Instanciar los modelos
    $carritoModel = new Carrito($conn);
    $clienteModel = new Cliente($conn);

    // Obtener los productos en el carrito
    $productosCarrito = $carritoModel->obtenerProductos($idUsuario);

    // Obtener la información del cliente
    $datosCliente = $clienteModel->obtenerInformacionCliente($idUsuario);
} catch (Exception $e) {
    die("Error al cargar la información del checkout: " . $e->getMessage());
}

// Calcular el total del carrito
$totalCarrito = array_reduce($productosCarrito, function ($total, $producto) {
    return $total + $producto['total'];
}, 0);
?>

<div class="checkout">
    <h1 class="checkout__titulo">Checkout</h1>

    <?php if (empty($productosCarrito)) : ?>
        <p>Tu carrito está vacío. <a href="/AmbienteWeb/views/usuarios/productos.php" class="boton-verde">Explora productos</a>.</p>
    <?php else : ?>
        <div class="checkout__cliente">
            <h2>Información del Cliente</h2>
            <p><strong>Nombre:</strong> <?= htmlspecialchars($datosCliente['nombre'] . ' ' . $datosCliente['apellidos']) ?></p>
            <p><strong>Provincia:</strong> <?= htmlspecialchars($datosCliente['provincia']) ?></p>
            <p><strong>Dirección:</strong> <?= htmlspecialchars($datosCliente['detalle_direccion']) ?></p>
        </div>

        <div class="checkout__productos">
            <h2>Productos en el carrito</h2>
            <table class="checkout__tabla">
                <thead>
                    <tr>
                        <th>Producto</th>
                        <th>Cantidad</th>
                        <th>Precio Unitario</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($productosCarrito as $producto) : ?>
                        <tr>
                            <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                            <td><?= htmlspecialchars($producto['cantidad']) ?></td>
                            <td>₡<?= number_format($producto['precio'], 1) ?></td>
                            <td>₡<?= number_format($producto['total'], 1) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <h4 class="checkout__total">Total: ₡<?= number_format($totalCarrito, 1) ?></h4>
        </div>

        <form action="/AmbienteWeb/controller/confirmarPedido.php" method="POST">
            <button type="submit" class="boton-verde">Confirmar Pedido</button>
        </form>
    <?php endif; ?>
</div>

<?php
require_once '../layout/footer.php';
?>
