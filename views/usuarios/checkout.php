

<!-- Es mejor cargar los css asi, que usar required -->
<link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/checkout.css">
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


<div class="container">
  <div class="card">
  <form action="/AmbienteWeb/controller/generarPedido.php" method="POST">
    <button type="submit" class="proceed">
        <svg class="sendicon" width="24" height="24" viewBox="0 0 24 24">
            <path d="M4,11V13H16L10.5,18.5L11.92,19.92L19.84,12L11.92,4.08L10.5,5.5L16,11H4Z"></path>
        </svg>
    </button>
</form>
    <img src="https://th.bing.com/th/id/R.3199df0e6d1daa6b20a55c39e60096d8?rik=DBXdYJQdMKduwA&pid=ImgRaw&r=0" class="logo-card">
    <label>Card number:</label>
    <input id="user" type="text" class="input cardnumber"  placeholder="1234 5678 9101 1121">
    <label>Name:</label>
    <input class="input name"  placeholder="Edgar Pérez">
    <label class="toleft">CCV:</label>
    <input class="input toleft ccv" placeholder="321">
</div>



<div class="receipt">
  <div class="checkout">
      <h1 class="checkout__titulo">Checkout</h1>

      <?php if (empty($productosCarrito)) : ?>
          <p>Tu carrito está vacío.</p>
      <?php else : ?>
          <div class="checkout__cliente">
              <h3>Información del Cliente</h3>
              <p><strong>Nombre:</strong> <?= htmlspecialchars($datosCliente['nombre'] . ' ' . $datosCliente['apellidos']) ?></p>
              <p><strong>Provincia:</strong> <?= htmlspecialchars($datosCliente['provincia']) ?></p>
              <p><strong>Dirección:</strong> <?= htmlspecialchars($datosCliente['detalle_direccion']) ?></p>
          </div>

          <hr class="hr">

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
          </div>
          <hr class="hr">
          <h4 class="checkout__total">Total: ₡<?= number_format($totalCarrito, 1) ?></h4>

          
      <?php endif; ?>
      
  </div>
</div>
<?php
require_once '../layout/footer.php';
?>