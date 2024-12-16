<?php
session_start();

require_once '../model/pedido.php';
require_once '../model/carrito.php';
require_once '../model/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // VERIFICACION DE USUARIO
    if (!isset($_SESSION['idUsuario'])) {
        header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=No%20autenticado");
        exit;
    }

    $idUsuario = $_SESSION['idUsuario'];
    
    // MODELOS
    $pedidoModel = new Pedido($conn);
    $carritoModel = new Carrito($conn);
    $productoModel = new Producto($conn);
    
    // PRODUCTOS DE CARRITO
    $productosCarrito = $carritoModel->obtenerProductos($idUsuario);

    if (empty($productosCarrito)) {
        header("Location: /AmbienteWeb/views/usuarios/carritoUsuario.php?error=Imposible%20completar%20la%20compra,%20el%20carrito%20esta%20vacío");
        exit;
    }

    // AGRUPAR POR EMPRENDIMIENTO
    $productosPorProveedor = [];

    foreach ($productosCarrito as $producto) {    
        $idProducto = $producto['id_producto'];
        $productoDetalle = $productoModel->obtenerProductoPorId($idProducto);

        if (!$productoDetalle) {
            header("Location: /AmbienteWeb/views/usuarios/carrito.php?error=Producto%20inválido");
            exit;
        }
        $idEmprendimiento = $productoDetalle['id_emprendimiento'];

        // AGRUPAR AL EMPRENDIMIENTO
        if (!isset($productosPorProveedor[$idEmprendimiento])) {
            $productosPorProveedor[$idEmprendimiento] = [];
        }
        $productosPorProveedor[$idEmprendimiento][] = [
            'id_producto' => $idProducto,
            'nombre_producto' => $productoDetalle['nombre_producto'],
            'cantidad' => $producto['cantidad'],
            'precio' => $productoDetalle['precio'],
            'stock' => $productoDetalle['stock']
        ];
    }

    $conn->begin_transaction();

    try {// CPREAR PEDIDO POR PROVEEDOR
        
        foreach ($productosPorProveedor as $idEmprendimiento => $productos) {

            $idPedido = $pedidoModel->insertarPedido($idUsuario);
            
            if (!$idPedido) {
                throw new Exception("Error al crear el pedido para el proveedor ID: $idEmprendimiento.");
            }

            // INSERTR CADA PRODUCTO EN EL PEDIDO
            foreach ($productos as $producto) {
                $idProducto = $producto['id_producto'];
                $cantidad = $producto['cantidad'];
                $precioUnitario = $producto['precio'];

                // REALIZAR INSERSIONES DE PRODUCTOS_PEDIDO
                $resultado = $pedidoModel->insertarProductoPedido($idPedido, $idProducto, $cantidad, $precioUnitario);
                if (!$resultado) {
                    throw new Exception("Error al asociar el producto ID: $idProducto al pedido ID: $idPedido.");
                }

                // ACTUALIZAR STOCK DEL PRODUCTO
                $nuevoStock = $producto['stock'] - $cantidad;
                if ($nuevoStock < 0) {
                    throw new Exception("Stock insuficiente para el producto ID: $idProducto.");
                }
                $actualizarStock = $productoModel->actualizarStock($idProducto, $nuevoStock);
                if (!$actualizarStock) {
                    throw new Exception("Error al actualizar el stock del producto ID: $idProducto.");
                }
            }
        }

        // VACIAR CARRITO
        $resultadoVaciarCarrito = $carritoModel->vaciarCarrito($idUsuario);
        if (!$resultadoVaciarCarrito) {
            throw new Exception("Error al vaciar el carrito.");
        }

        $conn->commit();

        // Redireccionar con éxito
        header("Location: /AmbienteWeb/views/usuarios/pedidosUsuario.php?success=Pedido%20generado%20exitosamente");
        exit;

    } catch (Exception $e) {
        // Revertir la transacción en caso de error
        $conn->rollback();
        error_log("Error al generar el pedido: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/usuarios/carritoUsuario.php?error=" . urlencode($e->getMessage()));
        exit;
    }
}
?>
