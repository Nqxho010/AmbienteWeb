<?php
require_once '../model/pedido.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idPedido'])) {
    $idPedido = (int)$_POST['idPedido'];

    try {
        $pedidoModel = new Pedido($conn);
        $resultado = $pedidoModel->actualizarEstadoPedido($idPedido, 4); // 4 = Completado

        if ($resultado) {
            header("Location: /AmbienteWeb/views/emprendimientos/detallePedido.php?id=$idPedido&success=Pedido%20marcado%20como%20Completado");
        } else {
            header("Location: /AmbienteWeb/views/emprendimientos/detallePedido.php?id=$idPedido&error=No%20se%20pudo%20actualizar%20el%20estado");
        }
    } catch (Exception $e) {
        error_log("Error al marcar pedido como completado: " . $e->getMessage());
        header("Location: /AmbienteWeb/views/emprendimientos/detallePedido.php?id=$idPedido&error=Error%20interno");
    }
}
