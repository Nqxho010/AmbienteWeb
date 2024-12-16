<?php
require_once '../../model/db.php';
require_once '../../model/pedido.php';

$titulo = 'Pedidos Completados o Cancelados';
require_once '../layout/head.php';
require_once '../layout/header.php';

if (!isset($_SESSION['idUsuario'])) {
    header("Location: /AmbienteWeb/views/sesion/inicioSesion.php?error=Debe%20iniciar%20sesión%20para%20ver%20sus%20pedidos");
    exit;
}

$idUsuario = $_SESSION['idUsuario'];

try {
    $pedidoModel = new Pedido($conn);
    $pedidosCompletados = $pedidoModel->obtenerPedidosCanceladosOEntregados($idUsuario);
} catch (Exception $e) {
    die("Error al cargar los pedidos: " . $e->getMessage());
}

// Captura de mensajes de controladores
$mensajeExito = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
$mensajeError = isset($_GET['error']) ? htmlspecialchars($_GET['error']) : null;

?>

<div class="pedidos">
    <h1 class="pedidos__titulo">Pedidos Completados o Cancelados</h1>

    <!-- Mensajes de controladores -->
    <?php if ($mensajeExito) : ?>
        <div class="alerta alerta-exito"><?= $mensajeExito ?></div>
    <?php endif; ?>
    <?php if ($mensajeError) : ?>
        <div class="alerta alerta-error"><?= $mensajeError ?></div>
    <?php endif; ?>

    <?php if (empty($pedidosCompletados)) : ?>
        <p>No tienes pedidos completados o cancelados. <a href="/AmbienteWeb/views/usuarios/productos.php" class="boton-verde">Explora productos</a>.</p>
    <?php else : ?>
        <table class="pedidos__tabla">
            <thead class="pedidos__thead">
                <tr>
                    <th>ID Pedido</th>
                    <th>Fecha</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody class="pedidos__tbody">
                <?php foreach ($pedidosCompletados as $pedido) : ?>
                    <tr>
                        <td><?= htmlspecialchars($pedido['id_pedido']) ?></td>
                        <td><?= htmlspecialchars($pedido['fecha']) ?></td>
                        <td><?= htmlspecialchars($pedido['estado_pedido']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php
require_once '../layout/footer.php';
?>
