<?php
require_once '../model/db.php';
require_once '../model/pedido.php';
require_once '../model/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idPedido'])) {
    $idPedido = (int)$_POST['idPedido'];

    try {
        // Instancias de los modelos
        $pedidoModel = new Pedido($conn);
        $productoModel = new Producto($conn);

        // Iniciar transacción
        $conn->begin_transaction();

        // Verificar el estado actual del pedido
        $detallePedido = $pedidoModel->obtenerPedidoPorId($idPedido);
        if (!$detallePedido || strtolower($detallePedido['estado_pedido']) !== 'activo') {
            throw new Exception("Solo se pueden cancelar pedidos con estado 'Activo'.");
        }

        // Obtener productos asociados al pedido
        $productosPedido = $pedidoModel->obtenerProductosDelPedido($idPedido);

        // Revertir el stock de los productos
        foreach ($productosPedido as $producto) {
            $idProducto = $producto['id_producto'];
            $cantidad = $producto['cantidad'];
            
            // Obtener stock actual del producto
            $productoDetalle = $productoModel->obtenerProductoPorId($idProducto);
            if (!$productoDetalle) {
                throw new Exception("Producto no encontrado: ID $idProducto.");
            }

            // Incrementar el stock
            $nuevoStock = $productoDetalle['stock'] + $cantidad;
            $actualizarStock = $productoModel->actualizarStock($idProducto, $nuevoStock);
            if (!$actualizarStock) {
                throw new Exception("Error al actualizar el stock del producto ID: $idProducto.");
            }
        }

        // Actualizar el estado del pedido a Cancelado
        $actualizarEstado = $pedidoModel->actualizarEstadoPedido($idPedido, 3); 
        if (!$actualizarEstado) {
            throw new Exception("Error al actualizar el estado del pedido ID: $idPedido.");
        }

        $conn->commit();

        // Redireccionar con éxito
        header("Location: /AmbienteWeb/index.php");
        exit;
    } catch (Exception $e) {
        $conn->rollback();
        error_log("Error al cancelar pedido: " . $e->getMessage());
        header("Location: /AmbienteWeb/index.php");
        exit;
    }
} else {
    header("Location: /AmbienteWeb/index.php");
    exit;
}
?>
