<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/detallePedido.css">
    <title>Detalle de Pedido</title>
</head>

<body>
    <?php include 'header.php'; ?> 

    <div class="detalle-pedido">
        <h2 class="detalle-pedido__titulo">Detalle pedido</h2>

        <div class="detalle-pedido__contenido">
            <div class="detalle-pedido__informacion">
                <p class="detalle-pedido__text"><strong>Nombre:</strong> Nombre del producto</p>
                <p class="detalle-pedido__text"><strong>Precio:</strong> ₡precio</p>
                <p class="detalle-pedido__text"><strong>Stock:</strong> cantidad en stock</p>
            </div>

            <div class="detalle-pedido__imagen">
                <img src="imagen_producto.jpg" alt="Imagen del producto" class="detalle-pedido__img">
            </div>
        </div>

        <div class="detalle-pedido__modificar">
            <label for="cantidad" class="detalle-pedido__label">Modificar Cantidad</label>
            <input type="number" id="cantidad" name="cantidad" class="detalle-pedido__entrada" placeholder="Ingrese la cantidad">
        </div>

        <div class="detalle-pedido__botones">
            <button type="button" class="boton-confirmar">Confirmar</button>
            <button type="button" class="boton-descartar">Descartar</button>
        </div>
    </div>

    <script src="js/menuUsuario.js"></script>

    <?php include 'footer.php'; ?> 
</body>

</html>