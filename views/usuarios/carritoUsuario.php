<?php
require_once '../../model/db.php'; 
require_once '../../model/carrito.php';

$titulo = 'Carrito de Compras';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20el%20carrito");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

try {
    $carritoModel = new Carrito($conn);
    $productosCarrito = $carritoModel->obtenerProductos($idUsuario);
} catch (Exception $e) {
    die("Error al cargar el carrito: " . $e->getMessage());
}

// Captura de mensajes de controladores
$mensajeExito = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
$mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

$totalCarrito = 0;
?>

<div class="carrito">
    <h1 class="carrito__titulo">Carrito de Compras</h1>

    <!-- Mensajes de controladores -->
    <?php if ($mensajeExito) : ?>
        <div class="alerta alerta-exito"><?= $mensajeExito ?></div>
    <?php endif; ?>
    <?php if ($mensajeError) : ?>
        <div class="alerta alerta-error"><?= $mensajeError ?></div>
    <?php endif; ?>

    <?php if (empty($productosCarrito)) : ?>
        <p>Tu carrito está vacío. <a href="/AmbienteWeb/views/usuarios/productos.php" class="boton-verde">Explora productos</a>.</p>
    <?php else : ?>
        <table class="carrito__tabla">
            <thead class="carrito__thead">
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Disponibles</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody class="carrito__tbody">
                <?php
                
                foreach ($productosCarrito as $producto) :
                    $totalCarrito += $producto['total'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($producto['nombre_producto']) ?></td>
                        <td>
                            <form action="/AmbienteWeb/controller/actualizarCarrito.php" method="POST">
                                <input type="hidden" name="idProducto" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                <input 
                                    type="number" 
                                    name="cantidad" 
                                    class="cantidad-input" 
                                    data-id-producto="<?= htmlspecialchars($producto['id_producto']) ?>" 
                                    min="1" 
                                    max="<?= htmlspecialchars($producto['stock']) ?>" 
                                    value="<?= htmlspecialchars($producto['cantidad']) ?>" 
                                    required>
                            </form>
                        </td>
                        <td><?= htmlspecialchars($producto['stock']) ?></td>
                        <td>₡<?= number_format($producto['precio'], 1) ?></td>
                        <td>₡<span class="total-producto"><?= number_format($producto['total'], 1) ?></span></td>
                        <td>
                            <!-- Botón para eliminar -->
                            <form action="/AmbienteWeb/controller/eliminarProductoCarrito.php" method="POST" style="display:inline;">
                                <input type="hidden" name="idProducto" value="<?= htmlspecialchars($producto['id_producto']) ?>">
                                <button type="submit" class="boton-rojo">Eliminar</button>
                            </form>
                        </td>
                    </tr>

                <?php endforeach; ?>
            </tbody>            
        </table>
        <h4 class="carrito__total">Total: ₡<span id="total-carrito"><?= number_format($totalCarrito, 1) ?></span></h4>
        <a href="/AmbienteWeb/views/usuarios/checkout.php" class="boton-verde">CheckOut</a>
        

    <?php endif; ?>
</div>


<script>
    $(document).ready(function() {
        $('.cantidad-input').on('change', function() {
            const maxCantidad = $(this).attr('max');
            const nuevaCantidad = $(this).val();

            // VALIDACIÓN
            if (nuevaCantidad < 1 || nuevaCantidad > maxCantidad) {
                alert('La cantidad debe estar entre 1 y ' + maxCantidad);
                return;
            }

            
            const form = $(this).closest('form'); 
            form.submit();
        });
    });


</script>

<?php
require_once '../layout/footer.php';
?>
