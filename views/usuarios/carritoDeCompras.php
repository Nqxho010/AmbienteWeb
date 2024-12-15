<?php
$titulo = ' Emprendedor 1';
require_once '../layout/header.php';
require_once '../layout/footer.php';
require_once "/AmbienteWeb/public/css/carritoDeCompras.css";
?>


    <h1 class="carritoTxt">Resumen del Carrito</h1>
    <div class="cart-display">
        <!-- Los productos y el total se cargarán aquí -->
    </div>
    <button class="eliminar-btn">Eliminar</button>
    <button class="pagar-btn" onclick="window.location.href='checkout.php'">Prodceder con el pago</button>
    <script src="/Jose/js/carritoDeCompras.js"></script>

    
    <?php include
     require_once '../layout/footer.php';?>
</body>

</html>
