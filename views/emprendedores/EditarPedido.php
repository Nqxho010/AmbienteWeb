
<?php
$titulo = 'Editar Pedido';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/editarPedidos.css">

    <h3 class="productosTitulo"> Mis Pedidos > Editar</h3>

    <div class="flex-container">
        <form class="form">
            
            <label for="nombre">Nombre del Pedido:</label>
            <input type="text" id="nombre_pedido" placeholder="Pedido de cremas" required>
            <br>
            <label for="Usuario">Usuario:</label>
            <input type="text" id="nombre_usuario" placeholder="Juan Pereira" required>
            <br>
            <label for="Usuario">Estado del pedido:</label>
            <input type="text" id="estado_pedido" placeholder="Ingresa tu salario bruto" required>
            <br>
            <label for="fecha">Fecha del pedido:</label>
            <input type="date" id="fecha" placeholder="11/28/2024" required>
            <br>
            <label for="stock">Cantidadd del pedido:</label>
            <input type="number" id="stock" placeholder="Ingresar Cantidad (Stock)" required>
            <br>
            <label for="img">Imagen:</label>
            <input type="image" id="img" placeholder="Insetar Imagen" >
            <br>
            <button class="boton-verde" type="submit">Editar</button>
            <br>
            <button class="boton-rojo" type="submit">Eliminar</button>

        </form>
    </div>
    
    <script src="/AmbienteWeb/public/js/menuUsuario.js"></script>

    <?php require_once '../layout/footer.php'; ?>