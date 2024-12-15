<?php
$titulo = 'ListaPedidos';
require_once '../layout/head.php';
require_once '../layout/header.php';
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
                <th>Estado</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Imagen</td>
                <td>Serum Humectante</td>
                <td>₡10500</td>
                <td>Juan</td>
                <td>3</td>
                <td>En camino</td>
                <td>
                <button class="boton-verde">Enviado</button>
                <button class="boton-verde" onclick="window.location.href='EditarPedido.php';">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>

            <tr>
                <td>Imagen</td>
                <td>Crema para manos natural</td>
                <td>₡5000</td>
                <td>Maria</td>
                <td>15</td>
                <td>Pendiente</td>
                <td>
                <button class="boton-verde">Enviar</button>
                <button class="boton-verde" onclick="window.location.href='EditarPedido.php';">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>

            <tr>
                <td>Imagen</td>
                <td>Maquillaje natural</td>
                <td>₡10500</td>
                <td>Isabela</td>
                <td>15</td>
                <td>En camino</td>
                <td>
                <button class="boton-verde">Enviado</button>
                <button class="boton-verde" onclick="window.location.href='EditarPedido.php';">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>

            <tr>
                <td>Imagen</td>
                <td>Serum Humectante</td>
                <td>₡4500</td>
                <td>Angelica</td>
                <td>15</td>
                <td>Pendiente</td>
                <td>
                <button class="boton-verde">Enviar</button>
                <button class="boton-verde" onclick="window.location.href='EditarPedido.php';">Editar</button>
                <button class="boton-rojo">Eliminar</button>
                </td>
            </tr>  

        </tbody>
    </table>
        </div>
    
    <script src="js/menuUsuario.js"></script>
   
  