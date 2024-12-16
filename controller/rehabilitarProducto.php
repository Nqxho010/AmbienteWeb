<?php
require_once '../model/producto.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProducto'])) {
    $idProducto = (int)$_POST['idProducto'];

    try {
        $productoModel = new Producto($conn);
        $resultado = $productoModel->activarProducto($idProducto);

        if ($resultado) {
            header("Location: /AmbienteWeb/views/emprendedores/misProductosDeshabilitados.php?success=Producto%20activado%20correctamente");
        } else {
            header("Location: /AmbienteWeb/views/emprendimientos/misProductosDeshabilitados.php?error=No%20se%20pudo%20activar%20el%20producto");
        }
    } catch (Exception $e) {
        error_log("Error al activar producto: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/emprendimientos/misProductosDeshabilitados.php?error=Error%20interno");
    }
}
