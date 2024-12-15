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
                            <input 
                                type="number" 
                                class="cantidad-input" 
                                data-id-producto="<?= htmlspecialchars($producto['id_producto']) ?>" 
                                min="1" 
                                max="<?= htmlspecialchars($producto['stock']) ?>" 
                                value="<?= htmlspecialchars($producto['cantidad']) ?>" 
                                required>
                        </td>
                        <td><?= htmlspecialchars($producto['stock']) ?></td>
                        <td>₡<?= number_format($producto['precio'], 1) ?></td>
                        <td>₡<span class="total-producto"><?= number_format($producto['total'], 1) ?></span></td>
                        <td>
                            <!-- Eliminar -->
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
        <a href="#" class="boton-verde">CheckOut</a>
    <?php endif; ?>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $('.cantidad-input').on('change', function() {
            const idProducto = $(this).data('id-producto');
            const nuevaCantidad = $(this).val();
            const maxCantidad = $(this).attr('max');

            // Validar que la cantidad sea válida
            if (nuevaCantidad < 1 || nuevaCantidad > maxCantidad) {
                alert('La cantidad debe estar entre 1 y ' + maxCantidad);
                return;
            }

            // Enviar la solicitud al controlador
            $.ajax({
                url: '/AmbienteWeb/controller/actualizarCarrito.php',
                type: 'POST',
                data: {
                    idProducto: idProducto,
                    cantidad: nuevaCantidad
                },
                success: function(response) {
                    // Actualizar el total del producto y el total del carrito en la interfaz
                    location.reload(); // Refresca la página para reflejar los cambios
                },
                error: function() {
                    alert('Error al actualizar la cantidad. Por favor, inténtalo nuevamente.');
                }
            });
        });
    });
</script>

<?php
require_once '../layout/footer.php';
?>
