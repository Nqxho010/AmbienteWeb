<?php
require_once '../model/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProducto'])) {
    $idProducto = (int)$_POST['idProducto'];

    try {
        $productoModel = new Producto($conn);
        $resultado = $productoModel->eliminarProducto($idProducto);

        if ($resultado) {
            header("Location: /AmbienteWeb/views/emprendedores/misProductos.php?success=Producto%20eliminado%20correctamente");
        } else {
            header("Location: /AmbienteWeb/views/emprendedores/misProductos.php?error=No%20se%20pudo%20eliminar%20el%20producto");
        }
    } catch (Exception $e) {
        error_log("Error al eliminar producto: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/emprendedores/misProductos.php?error=Error%20interno");
    }
}
