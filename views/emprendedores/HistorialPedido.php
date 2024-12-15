<?php
$titulo = 'Historial Pedidos';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../layout/footer.php';
?>
    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/Emprendedores.css">

        <div>
            <h2>Lista de Pedidos</h2>
            <button class="boton-verde">Agregar Pedido</button>
            <button class="boton-verde">Historial de Pedidos</button>

    <table class="table-productos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Cliente</th>
                <th>Cantidad Pedido</th>
                <th>Fecha de entrega</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Imagen</td>
                <td>Serum Pasta de dientes</td>
                <td>₡7500</td>
                <td>Luis</td>
                <td>3</td>
                <td>3/10/1013</td>               
                </td>
            </tr>
            <tr>
                <td>Imagen</td>
                <td>Serum Humectante</td>
                <td>₡10500</td>
                <td>Juan</td>
                <td>3</td>
                <td>3/10/1013</td>               
                </td>
            </tr>
            <tr>
                <td>Imagen</td>
                <td>Jabon</td>
                <td>₡7500</td>
                <td>Maria</td>
                <td>3</td>
                <td>3/10/1013</td>               
                </td>
            </tr>

          

        </tbody>
    </table>
        </div>
    
    <script src="js/menuUsuario.js"></script>
