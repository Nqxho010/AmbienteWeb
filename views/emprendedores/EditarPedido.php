
<?php
$titulo = 'Editar Pedido';
require_once '../layout/head.php';
require_once '../layout/header.php';
?>

    <link rel="stylesheet" type="text/css" href="/AmbienteWeb/public/css/editarPedidos.css">

    <h3 class="productosTitulo"> Mis productos > Editar</h3>

    <div class="flex-container">
        <form class="form">
            
            
            <label for="nombre">Nombre del Producto:</label>
            <input type="text" id="nombre" placeholder="Ingresar nombre del Producto:" required>
            <br>
            <label for="descripcion">Descripcion:</label>
            <input type="number" id="salarioBruto" placeholder="Ingresa tu salario bruto" required>
            <br>
            <label for="precio">Precio (₡):</label>
            <input type="number" id="precio" placeholder="Ingresar Precio" required>
            <br>
            <label for="stock">Stock:</label>
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