<?php
$titulo = ' Producto Empleado';
require_once '../layout/head.php';
require_once '../layout/header.php';
require_once '../layout/footer.php';
?>
    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/Emprendedores.css">

        <div>
            <h2>Lista de Productos</h2>
            <button class="boton-verde">Agregar</button>
    <table class="table-productos">
        <thead>
            <tr>
                <th>Imagen</th>
                <th>Producto</th>
                <th>Precio</th>
                <th>Stock</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>Producto 1</td>
                <td>Serum Humectante</td>
                <td>₡10500</td>
                <td>20</td>
                <td>
                <button class="boton-verde" onclick="window.location.href='EditarProducto.php';">Editar</button>
                <button class="boton-verde" onclick="window.location.href='EditarProducto.php';">Eliminar</button>
                </td>
            </tr>
            <tr>
                <td>Producto 2</td>
                <td>Exfoliante Natural</td>
                <td>₡11500</td>
                <td>10</td>
                <td>
                <button class="boton-verde" onclick="window.location.href='EditarProducto.php';">Editar</button>
                <button class="boton-verde" onclick="window.location.href='EditarProducto.php';">Eliminar</button>
                </td>
            </tr>
            <tr>
                <td>Producto 3</td>
                <td>Pasta de Dientes Natural</td>
                <td>₡10500</td>
                <td>15</td>
                <td>
                <button class="boton-verde" onclick="window.location.href='EditarProducto.php';">Editar</button>
                <button class="boton-verde" onclick="window.location.href='EditarProducto.php';">Eliminar</button>
                </td>
            </tr>
        </tbody>
    </table>
        </div>
    
    <script src="js/menuUsuario.js"></script>
  