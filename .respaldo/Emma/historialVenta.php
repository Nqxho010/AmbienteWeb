<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/historialVenta.css">
    <title>Historial de Pedidos</title>
</head>

<body>
    <?php include 'header.php'; ?> 

    <div class="historial-pedidos">
        <h2 class="historial-pedidos__titulo">Historial de Pedidos</h2>
        <table class="tabla-historial">
            <thead>
                <tr class="tabla-historial__fila">
                    <th class="tabla-historial__header-cell">ID Usuario</th>
                    <th class="tabla-historial__header-cell">Producto</th>
                    <th class="tabla-historial__header-cell">Precio</th>
                    <th class="tabla-historial__header-cell">Unidades</th>
                    <th class="tabla-historial__header-cell">Costo</th>
                </tr>
            </thead>
            <tbody>
                <tr class="tabla-historial__fila">
                    <td class="tabla-historial__body-cell">02</td>
                    <td class="tabla-historial__body-cell">Serum Humectante</td>
                    <td class="tabla-historial__body-cell">₡5000</td>
                    <td class="tabla-historial__body-cell">20</td>
                    <td class="tabla-historial__body-cell">₡130000</td>
                </tr>
                
            </tbody>
        </table>
    </div>

    <script src="js/menuUsuario.js"></script>

    <?php include 'footer.php'; ?> 
</body>

</html>